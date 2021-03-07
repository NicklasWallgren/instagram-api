<?php
declare(strict_types = 1);

use Phan\Issue;

/**
 * This configuration will be read and overlaid on top of the
 * default configuration. Command line arguments will be applied
 * after this file is read.
 *
 * @see src/Phan/Config.php
 * See Config for all configurable options.
 *
 * A Note About Paths
 * ==================
 *
 * Files referenced from this file should be defined as
 *
 * ```
 *   Config::projectPath('relative_path/to/file')
 * ```
 *
 * where the relative path is relative to the root of the
 * project which is defined as either the working directory
 * of the phan executable or a path passed in via the CLI
 * '-d' flag.
 */
return [
    // Supported values: '7.0', '7.1', '7.2', '7.3', null.
    // If this is set to null,
    // then Phan assumes the PHP version which is closest to the minor version
    // of the php executable used to execute phan.
    "target_php_version" => 7.2,

    // Default: true. If this is set to true,
    // and target_php_version is newer than the version used to run Phan,
    // Phan will act as though functions added in newer PHP versions exist.
    //
    // NOTE: Currently, this only affects Closure::fromCallable
    'pretend_newer_core_functions_exist' => true,

    // If true, missing properties will be created when
    // they are first seen. If false, we'll report an
    // error message.
    "allow_missing_properties" => false,

    // Allow null to be cast as any type and for any
    // type to be cast to null.
    "null_casts_as_any_type" => false,

    // Allow null to be cast as any array-like type
    // This is an incremental step in migrating away from null_casts_as_any_type.
    // If null_casts_as_any_type is true, this has no effect.
    'null_casts_as_array' => false,

    // Allow any array-like type to be cast to null.
    // This is an incremental step in migrating away from null_casts_as_any_type.
    // If null_casts_as_any_type is true, this has no effect.
    'array_casts_as_null' => false,

    // If enabled, Phan will warn if **any** type in the argument's type
    // cannot be cast to a type in the parameter's expected type.
    // Setting this to true will introduce a large number of false positives (and some bugs).
    // (For self-analysis, Phan has a large number of suppressions and file-level suppressions, due to \ast\Node being difficult to type check)
    'strict_param_checking' => true,

    // If enabled, Phan will warn if **any** type in a property assignment's type
    // cannot be cast to a type in the property's expected type.
    // Setting this to true will introduce a large number of false positives (and some bugs).
    // (For self-analysis, Phan has a large number of suppressions and file-level suppressions, due to \ast\Node being difficult to type check)
    'strict_property_checking' => true,

    // If enabled, Phan will warn if **any** type in the return statement's type
    // cannot be cast to a type in the method's declared return type.
    // Setting this to true will introduce a large number of false positives (and some bugs).
    // (For self-analysis, Phan has a large number of suppressions and file-level suppressions, due to \ast\Node being difficult to type check)
    'strict_return_checking' => true,

    // If enabled, scalars (int, float, bool, string, null)
    // are treated as if they can cast to each other.
    // This does not affect checks of array keys. See scalar_array_key_cast.
    'scalar_implicit_cast' => false,

    // If enabled, any scalar array keys (int, string)
    // are treated as if they can cast to each other.
    // E.g. array<int,stdClass> can cast to array<string,stdClass> and vice versa.
    // Normally, a scalar type such as int could only cast to/from int and mixed.
    'scalar_array_key_cast' => false,

    // If this has entries, scalars (int, float, bool, string, null)
    // are allowed to perform the casts listed.
    // E.g. ['int' => ['float', 'string'], 'float' => ['int'], 'string' => ['int'], 'null' => ['string']]
    // allows casting null to a string, but not vice versa.
    // (subset of scalar_implicit_cast)
    'scalar_implicit_partial' => [],

    // If true, seemingly undeclared variables in the global
    // scope will be ignored. This is useful for projects
    // with complicated cross-file globals that you have no
    // hope of fixing.
    'ignore_undeclared_variables_in_global_scope' => false,

    // Backwards Compatibility Checking (This is very slow)
    'backward_compatibility_checks' => false,

    // If true, check to make sure the return type declared
    // in the doc-block (if any) matches the return type
    // declared in the method signature. This process is
    // slow.
    'check_docblock_signature_return_type_match' => true,

    // If true, check to make sure the return type declared
    // in the doc-block (if any) matches the return type
    // declared in the method signature. This process is
    // slow.
    'check_docblock_signature_param_type_match' => true,

    // (*Requires check_docblock_signature_param_type_match to be true*)
    // If true, make narrowed types from phpdoc params override
    // the real types from the signature, when real types exist.
    // (E.g. allows specifying desired lists of subclasses,
    //  or to indicate a preference for non-nullable types over nullable types)
    // Affects analysis of the body of the method and the param types passed in by callers.
    'prefer_narrowed_phpdoc_param_type' => true,

    // (*Requires check_docblock_signature_return_type_match to be true*)
    // If true, make narrowed types from phpdoc returns override
    // the real types from the signature, when real types exist.
    // (E.g. allows specifying desired lists of subclasses,
    //  or to indicate a preference for non-nullable types over nullable types)
    // Affects analysis of return statements in the body of the method and the return types passed in by callers.
    'prefer_narrowed_phpdoc_return_type' => true,

    // If enabled, check all methods that override a
    // parent method to make sure its signature is
    // compatible with the parent's. This check
    // can add quite a bit of time to the analysis.
    // This will also check if final methods are overridden, etc.
    'analyze_signature_compatibility' => true,

    // Set this to true to allow contravariance in real parameter types of method overrides (Introduced in php 7.2)
    // See https://secure.php.net/manual/en/migration72.new-features.php#migration72.new-features.param-type-widening
    // (Users may enable this if analyzing projects that support only php 7.2+)
    // This is false by default. (Will warn if real parameter types are omitted in an override)
    'allow_method_param_type_widening' => false,

    // Set this to true to make Phan guess that undocumented parameter types
    // (for optional parameters) have the same type as default values
    // (Instead of combining that type with `mixed`).
    // E.g. `function($x = 'val')` would make Phan infer that $x had a type of `string`, not `string|mixed`.
    // Phan will not assume it knows specific types if the default value is false or null.
    'guess_unknown_parameter_type_using_default' => false,

    // This setting maps case insensitive strings to union types.
    // This is useful if a project uses phpdoc that differs from the phpdoc2 standard.
    // If the corresponding value is the empty string, Phan will ignore that union type (E.g. can ignore 'the' in `@return the value`)
    // If the corresponding value is not empty, Phan will act as though it saw the corresponding union type when the keys show up in a UnionType of @param, @return, @var, @property, etc.
    //
    // This matches the **entire string**, not parts of the string.
    // (E.g. `@return the|null` will still look for a class with the name `the`, but `@return the` will be ignored with the below setting)
    //
    // (These are not aliases, this setting is ignored outside of doc comments).
    // (Phan does not check if classes with these names exist)
    //
    // Example setting: ['unknown' => '', 'number' => 'int|float', 'char' => 'string', 'long' => 'int', 'the' => '']
    'phpdoc_type_mapping' => [ ],

    // Set to true in order to attempt to detect dead
    // (unreferenced) code. Keep in mind that the
    // results will only be a guess given that classes,
    // properties, constants and methods can be referenced
    // as variables (like `$class->$property` or
    // `$class->$method()`) in ways that we're unable
    // to make sense of.
    'dead_code_detection' => false,

    // Set to true in order to attempt to detect unused variables.
    // dead_code_detection will also enable unused variable detection.
    'unused_variable_detection' => true,

    // Set to true in order to force tracking references to elements
    // (functions/methods/consts/protected).
    // dead_code_detection is another option which also causes references
    // to be tracked.
    'force_tracking_references' => false,

    // If true, then run a quick version of checks that takes less time.
    // False by default.
    "quick_mode" => false,

    // If true, then before analysis, try to simplify AST into a form
    // which improves Phan's type inference in edge cases.
    //
    // This may conflict with 'dead_code_detection'.
    // When this is true, this slows down analysis slightly.
    //
    // E.g. rewrites `if ($a = value() && $a > 0) {...}`
    // into $a = value(); if ($a) { if ($a > 0) {...}}`
    "simplify_ast" => true,

    // If true, Phan will read `class_alias` calls in the global scope,
    // then (1) create aliases from the *parsed* files if no class definition was found,
    // and (2) emit issues in the global scope if the source or target class is invalid.
    // (If there are multiple possible valid original classes for an aliased class name,
    //  the one which will be created is unspecified.)
    // NOTE: THIS IS EXPERIMENTAL, and the implementation may change.
    'enable_class_alias_support' => false,

    // Enable or disable support for generic templated
    // class types.
    'generic_types_enabled' => true,

    // If enabled, warn about throw statement where the exception types
    // are not documented in the PHPDoc of functions, methods, and closures.
    'warn_about_undocumented_throw_statements' => true,

    // If enabled (and warn_about_undocumented_throw_statements is enabled),
    // warn about function/closure/method calls that have (at)throws
    // without the invoking method documenting that exception.
    // TODO: Enable for self-analysis
    'warn_about_undocumented_exceptions_thrown_by_invoked_functions' => true,

    // If this is a list, Phan will not warn about lack of documentation of (at)throws
    // for any of the listed classes or their subclasses.
    // This setting only matters when warn_about_undocumented_throw_statements is true.
    // The default is the empty array (Warn about every kind of Throwable)
    'exception_classes_with_optional_throws_phpdoc' => [
        'RuntimeException',
        'AssertionError',
        'TypeError',
    ],

    // Setting this to true makes the process assignment for file analysis
    // as predictable as possible, using consistent hashing.
    // Even if files are added or removed, or process counts change,
    // relatively few files will move to a different group.
    // (use when the number of files is much larger than the process count)
    // NOTE: If you rely on Phan parsing files/directories in the order
    // that they were provided in this config, don't use this)
    // See https://github.com/phan/phan/wiki/Different-Issue-Sets-On-Different-Numbers-of-CPUs
    'consistent_hashing_file_order' => false,

    // Override to hardcode existence and types of (non-builtin) globals.
    // Class names should be prefixed with '\\'.
    // (E.g. ['_FOO' => '\\FooClass', 'page' => '\\PageClass', 'userId' => 'int'])
    'globals_type_map' => [],

    // The minimum severity level to report on. This can be
    // set to Issue::SEVERITY_LOW, Issue::SEVERITY_NORMAL or
    // Issue::SEVERITY_CRITICAL.
    'minimum_severity' => Issue::SEVERITY_LOW,

    // Add any issue types (such as 'PhanUndeclaredMethod')
    // here to inhibit them from being reported
    'suppress_issue_types' => [
        'PhanPluginDescriptionlessCommentOnProtectedProperty',
        'PhanUnreferencedClosure',  // False positives seen with closures in arrays, TODO: move closure checks closer to what is done by unused variable plugin
        'PhanPossiblyFalseTypeArgumentInternal',
        'PhanPossiblyNullTypeArgumentInternal',
        // TODO: Fix and remove suppression for this plugin
        'PhanPluginDescriptionlessCommentOnPrivateProperty',

        'PhanPluginNoCommentOnProtectedMethod',
        'PhanPluginDescriptionlessCommentOnProtectedMethod',
        'PhanPluginNoCommentOnPrivateMethod',
        'PhanPluginDescriptionlessCommentOnPrivateMethod',
        'PhanPluginDescriptionlessCommentOnPublicMethod',
        'PhanUndeclaredInvokeInCallable',
        'PhanPluginNoCommentOnPublicMethod'
    ],

    // If empty, no filter against issues types will be applied.
    // If non-empty, only issues within the list will be emitted
    // by Phan.
    //
    // See https://github.com/phan/phan/wiki/Issue-Types-Caught-by-Phan
    // for the full list of issues that Phan detects.
    'whitelist_issue_types' => [
        // 'PhanAccessClassConstantInternal',
        // 'PhanAccessClassConstantPrivate',
        // 'PhanAccessClassConstantProtected',
        // 'PhanAccessClassInternal',
        // 'PhanAccessConstantInternal',
        // 'PhanAccessMethodInternal',
        // 'PhanAccessMethodPrivate',
        // 'PhanAccessMethodPrivateWithCallMagicMethod',
        // 'PhanAccessMethodProtected',
        // 'PhanAccessMethodProtectedWithCallMagicMethod',
        // 'PhanAccessNonStaticToStatic',
        // 'PhanAccessOwnConstructor',
        // 'PhanAccessPropertyInternal',
        // 'PhanAccessPropertyPrivate',
        // 'PhanAccessPropertyProtected',
        // 'PhanAccessPropertyStaticAsNonStatic',
        // 'PhanAccessSignatureMismatch',
        // 'PhanAccessSignatureMismatchInternal',
        // 'PhanAccessStaticToNonStatic',
        // 'PhanClassContainsAbstractMethod',
        // 'PhanClassContainsAbstractMethodInternal',
        // 'PhanCommentParamOnEmptyParamList',
        // 'PhanCommentParamWithoutRealParam',
        // 'PhanCompatibleExpressionPHP7',
        // 'PhanCompatiblePHP7',
        // 'PhanContextNotObject',
        // 'PhanDeprecatedClass',
        // 'PhanDeprecatedFunction',
        // 'PhanDeprecatedFunctionInternal',
        // 'PhanDeprecatedInterface',
        // 'PhanDeprecatedProperty',
        // 'PhanDeprecatedTrait',
        // 'PhanEmptyFile',
        // 'PhanGenericConstructorTypes',
        // 'PhanGenericGlobalVariable',
        // 'PhanIncompatibleCompositionMethod',
        // 'PhanIncompatibleCompositionProp',
        // 'PhanInvalidCommentForDeclarationType',
        // 'PhanMismatchVariadicComment',
        // 'PhanMismatchVariadicParam',
        // 'PhanMisspelledAnnotation',
        // 'PhanNonClassMethodCall',
        // 'PhanNoopArray',
        // 'PhanNoopClosure',
        // 'PhanNoopConstant',
        // 'PhanNoopProperty',
        // 'PhanNoopVariable',
        // 'PhanParamRedefined',
        // 'PhanParamReqAfterOpt',
        // 'PhanParamSignatureMismatch',
        // 'PhanParamSignatureMismatchInternal',
        // 'PhanParamSignaturePHPDocMismatchHasNoParamType',
        // 'PhanParamSignaturePHPDocMismatchHasParamType',
        // 'PhanParamSignaturePHPDocMismatchParamIsNotReference',
        // 'PhanParamSignaturePHPDocMismatchParamIsReference',
        // 'PhanParamSignaturePHPDocMismatchParamNotVariadic',
        // 'PhanParamSignaturePHPDocMismatchParamType',
        // 'PhanParamSignaturePHPDocMismatchParamVariadic',
        // 'PhanParamSignaturePHPDocMismatchReturnType',
        // 'PhanParamSignaturePHPDocMismatchTooFewParameters',
        // 'PhanParamSignaturePHPDocMismatchTooManyRequiredParameters',
        // 'PhanParamSignatureRealMismatchHasNoParamType',
        // 'PhanParamSignatureRealMismatchHasNoParamTypeInternal',
        // 'PhanParamSignatureRealMismatchHasParamType',
        // 'PhanParamSignatureRealMismatchHasParamTypeInternal',
        // 'PhanParamSignatureRealMismatchParamIsNotReference',
        // 'PhanParamSignatureRealMismatchParamIsNotReferenceInternal',
        // 'PhanParamSignatureRealMismatchParamIsReference',
        // 'PhanParamSignatureRealMismatchParamIsReferenceInternal',
        // 'PhanParamSignatureRealMismatchParamNotVariadic',
        // 'PhanParamSignatureRealMismatchParamNotVariadicInternal',
        // 'PhanParamSignatureRealMismatchParamType',
        // 'PhanParamSignatureRealMismatchParamTypeInternal',
        // 'PhanParamSignatureRealMismatchParamVariadic',
        // 'PhanParamSignatureRealMismatchParamVariadicInternal',
        // 'PhanParamSignatureRealMismatchReturnType',
        // 'PhanParamSignatureRealMismatchReturnTypeInternal',
        // 'PhanParamSignatureRealMismatchTooFewParameters',
        // 'PhanParamSignatureRealMismatchTooFewParametersInternal',
        // 'PhanParamSignatureRealMismatchTooManyRequiredParameters',
        // 'PhanParamSignatureRealMismatchTooManyRequiredParametersInternal',
        // 'PhanParamSpecial1',
        // 'PhanParamSpecial2',
        // 'PhanParamSpecial3',
        // 'PhanParamSpecial4',
        // 'PhanParamTooFew',
        // 'PhanParamTooFewInternal',
        // 'PhanParamTooMany',
        // 'PhanParamTooManyInternal',
        // 'PhanParamTypeMismatch',
        // 'PhanParentlessClass',
        // 'PhanRedefineClass',
        // 'PhanRedefineClassAlias',
        // 'PhanRedefineClassInternal',
        // 'PhanRedefineFunction',
        // 'PhanRedefineFunctionInternal',
        // 'PhanRequiredTraitNotAdded',
        // 'PhanStaticCallToNonStatic',
        // 'PhanSyntaxError',
        // 'PhanTemplateTypeConstant',
        // 'PhanTemplateTypeStaticMethod',
        // 'PhanTemplateTypeStaticProperty',
        // 'PhanTraitParentReference',
        // 'PhanTypeArrayOperator',
        // 'PhanTypeArraySuspicious',
        // 'PhanTypeComparisonFromArray',
        // 'PhanTypeComparisonToArray',
        // 'PhanTypeConversionFromArray',
        // 'PhanTypeInstantiateAbstract',
        // 'PhanTypeInstantiateInterface',
        // 'PhanTypeInvalidClosureScope',
        // 'PhanTypeInvalidLeftOperand',
        // 'PhanTypeInvalidRightOperand',
        // 'PhanTypeMismatchArgument',
        // 'PhanTypeMismatchArgumentInternal',
        // 'PhanTypeMismatchDeclaredParam',
        // 'PhanTypeMismatchDeclaredReturn',
        // 'PhanTypeMismatchDefault',
        // 'PhanTypeMismatchForeach',
        // 'PhanTypeMismatchProperty',
        // 'PhanTypeMismatchReturn',
        // 'PhanTypeMissingReturn',
        // 'PhanTypeNonVarPassByRef',
        // 'PhanTypeParentConstructorCalled',
        // 'PhanTypeSuspiciousIndirectVariable',
        // 'PhanTypeVoidAssignment',
        // 'PhanUnanalyzable',
        // 'PhanUndeclaredAliasedMethodOfTrait',
        // 'PhanUndeclaredClass',
        // 'PhanUndeclaredClassAliasOriginal',
        // 'PhanUndeclaredClassCatch',
        // 'PhanUndeclaredClassConstant',
        // 'PhanUndeclaredClassInstanceof',
        // 'PhanUndeclaredClassMethod',
        // 'PhanUndeclaredClassReference',
        // 'PhanUndeclaredClosureScope',
        // 'PhanUndeclaredConstant',
        // 'PhanUndeclaredExtendedClass',
        // 'PhanUndeclaredFunction',
        // 'PhanUndeclaredInterface',
        // 'PhanUndeclaredMethod',
        // 'PhanUndeclaredProperty',
        // 'PhanUndeclaredStaticMethod',
        // 'PhanUndeclaredStaticProperty',
        // 'PhanUndeclaredTrait',
        // 'PhanUndeclaredTypeParameter',
        // 'PhanUndeclaredTypeProperty',
        // 'PhanUndeclaredTypeReturnType',
        // 'PhanUndeclaredVariable',
        // 'PhanUndeclaredVariableDim',
        // 'PhanUnextractableAnnotation',
        // 'PhanUnextractableAnnotationPart',
        // 'PhanUnreferencedClass',
        // 'PhanUnreferencedConstant',
        // 'PhanUnreferencedMethod',
        // 'PhanUnreferencedProperty',
        // 'PhanVariableUseClause',
    ],

    // A list of files to include in analysis
    'file_list' => [
        // 'vendor/phpunit/phpunit/src/Framework/TestCase.php',
    ],

    // A regular expression to match files to be excluded
    // from parsing and analysis and will not be read at all.
    //
    // This is useful for excluding groups of test or example
    // directories/files, unanalyzable files, or files that
    // can't be removed for whatever reason.
    // (e.g. '@Test\.php$@', or '@vendor/.*/(tests|Tests)/@')
    'exclude_file_regex' => '@^vendor/.*/(tests?|Tests?)/@',

    // A file list that defines files that will be excluded
    // from parsing and analysis and will not be read at all.
    //
    // This is useful for excluding hopelessly unanalyzable
    // files that can't be removed for whatever reason.
    'exclude_file_list' => [

    ],

    // The number of processes to fork off during the analysis
    // phase.
    'processes' => 1,

    // A list of directories that should be parsed for class and
    // method information. After excluding the directories
    // defined in exclude_analysis_directory_list, the remaining
    // files will be statically analyzed for errors.
    //
    // Thus, both first-party and third-party code being used by
    // your application should be included in this list.
    'directory_list' => [
        'src',
        'vendor/guzzlehttp/',
        'vendor/psr/http-message',
        'vendor/webmozart/assert',
        'vendor/tebru/',
        'vendor/webmozart/',
    ],

    // List of case-insensitive file extensions supported by Phan.
    // (e.g. php, html, htm)
    'analyzed_file_extensions' => ['php'],

    // A directory list that defines files that will be excluded
    // from static analysis, but whose class and method
    // information should be included.
    //
    // Generally, you'll want to include the directories for
    // third-party code (such as "vendor/") in this list.
    //
    // n.b.: If you'd like to parse but not analyze 3rd
    //       party code, directories containing that code
    //       should be added to the `directory_list` as
    //       to `exclude_analysis_directory_list`.
    "exclude_analysis_directory_list" => [
        'vendor/',
        'src/Http/Guzzle/',
        'src/Support/',
    ],

    // By default, Phan will log error messages to stdout if PHP is using options that slow the analysis.
    // (e.g. PHP is compiled with --enable-debug or when using XDebug)
    'skip_slow_php_options_warning' => false,

    // You can put paths to internal stubs in this config option.
    // Phan will continue using its detailed type annotations, but load the constants, classes, functions, and classes (and their Reflection types) from these stub files (doubling as valid php files).
    // Use a different extension from php to avoid accidentally loading these.
    // The 'mkstubs' script can be used to generate your own stubs (compatible with php 7.0+ right now)
    'autoload_internal_extension_signatures' => [
        'ast'         => '.phan/internal_stubs/ast.phan_php',
        'ctype'       => '.phan/internal_stubs/ctype.phan_php',
        'pcntl'       => '.phan/internal_stubs/pcntl.phan_php',
        'posix'       => '.phan/internal_stubs/posix.phan_php',
        'readline'    => '.phan/internal_stubs/readline.phan_php',
        'sysvmsg'     => '.phan/internal_stubs/sysvmsg.phan_php',
        'sysvsem'     => '.phan/internal_stubs/sysvsem.phan_php',
        'sysvshm'     => '.phan/internal_stubs/sysvshm.phan_php',
    ],

    // Set this to false to emit PhanUndeclaredFunction issues for internal functions that Phan has signatures for,
    // but aren't available in the codebase, or the internal functions used to run phan (may lead to false positives if an extension isn't loaded)
    // If this is true(default), then Phan will not warn.
    // Also see 'autoload_internal_extension_signatures' for an alternative way to fix this type of issue.
    'ignore_undeclared_functions_with_known_signatures' => false,

    'plugin_config' => [
        // A list of 1 or more PHP binaries (Absolute path or program name found in $PATH)
        // to use to analyze your files with PHP's native `--syntax-check`.
        //
        // This can be used to simultaneously run PHP's syntax checks with multiple PHP versions.
        // e.g. `'plugin_config' => ['php_native_syntax_check_binaries' => ['php72', 'php70', 'php56']]`
        // if all of those programs can be found in $PATH

        // 'php_native_syntax_check_binaries' => [PHP_BINARY],

        // The maximum number of `php --syntax-check` processes to run at any point in time (Minimum: 1).
        // This may be temporarily higher if php_native_syntax_check_binaries has more elements than this process count.
        'php_native_syntax_check_max_processes' => 4,

        // blacklist of methods to warn about for HasPHPDocPlugin
        'has_phpdoc_method_ignore_regex' => '@^Phan\\\\Tests\\\\.*::(test.*|.*Provider)$@',
    ],

    // A list of plugin files to execute
    // NOTE: values can be the base name without the extension for plugins bundled with Phan (E.g. 'AlwaysReturnPlugin')
    // or relative/absolute paths to the plugin (Relative to the project root).
    'plugins' => [
        'AlwaysReturnPlugin',
        'DemoPlugin',
        'DollarDollarPlugin',
        'UnreachableCodePlugin',
        'DuplicateArrayKeyPlugin',
        'PregRegexCheckerPlugin',
        'PrintfCheckerPlugin',
        'UnknownElementTypePlugin',
        'DuplicateExpressionPlugin',
        'NoAssertPlugin',
        'HasPHPDocPlugin',
        'vendor/drenso/phan-extensions/Plugin/Annotation/SymfonyAnnotationPlugin.php'
    ],
];
