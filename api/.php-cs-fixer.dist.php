<?php
$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__ . '/app')
    ->in(__DIR__ . '/routes')
    ->in(__DIR__ . '/database')
    ->in(__DIR__ . '/tests')
    ->exclude('var')
    ->exclude('public')
    ->exclude('vendor')
;
return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_indentation' => true,
        'array_syntax' => ['syntax' => 'short'],
        'combine_consecutive_unsets' => true,
        'class_attributes_separation' => ['elements' => ['method' => 'one', 'property' => 'one', 'const' => 'one']],
        'multiline_whitespace_before_semicolons' => false,
        'single_quote' => true,
        'binary_operator_spaces' => [
            'operators' => [
                '=>' => 'align_single_space_by_scope',
            ]
        ],
        'blank_line_after_opening_tag' => true,
        'blank_line_before_statement' => [
            'statements' => ['continue', 'return', 'break', 'exit', 'if', 'switch', 'try', 'throw']
        ],
        'braces' => [
            'position_after_functions_and_oop_constructs' => 'same',
            'allow_single_line_closure' => true,
        ],
        // 'cast_spaces' => true,
        'class_definition' => ['single_line' => true],
        'concat_space' => ['spacing' => 'one'],
        'declare_equal_normalize' => ['space' => 'single'],
        'function_typehint_space' => true,
        'single_line_comment_style' => ['comment_types' => ['hash']],
        'include' => true,
        'lowercase_cast' => true,
        'native_function_casing' => true,
        // 'new_with_braces' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'blank_lines_before_namespace' => false,
        'no_empty_comment' => true,
        'no_empty_phpdoc' => true,
        // 'no_empty_statement' => true,
        'no_extra_blank_lines' => [
            'tokens' => [
                // 'curly_brace_block',
                'extra',
                // 'parenthesis_brace_block',
                // 'square_brace_block',
                // 'throw',
                // 'use',
            ]
        ],
        // 'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        // 'no_mixed_echo_print' => array('use' => 'echo'),
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_short_bool_cast' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_spaces_around_offset' => true,
        'no_trailing_comma_in_list_call' => true,
        'no_trailing_comma_in_singleline' => true,
        // 'no_unneeded_control_parentheses' => true,
        'no_unused_imports' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_whitespace_in_blank_line' => true,
        'normalize_index_brace' => true,
        'object_operator_without_whitespace' => true,
        // 'php_unit_fqcn_annotation' => true,
        // 'phpdoc_align' => true,
        'phpdoc_annotation_without_dot' => true,
        'phpdoc_indent' => true,
        // 'phpdoc_inline_tag' => true,
        // 'phpdoc_no_access' => true,
        // 'phpdoc_no_alias_tag' => true,
        // 'phpdoc_no_empty_return' => true,
        // 'phpdoc_no_package' => true,
        // 'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_return_self_reference' => ['replacements' => ['this' => 'self']],
        'phpdoc_scalar' => true,
        // 'phpdoc_separation' => true,
        // 'phpdoc_single_line_var_spacing' => true,
        // 'phpdoc_summary' => true,
        // 'phpdoc_to_comment' => true,
        'phpdoc_trim' => true,
        'phpdoc_types' => true,
        'phpdoc_var_without_name' => true,
        // 'increment_style' => true,
        'return_type_declaration' => ['space_before' => 'one'],
        // 'self_accessor' => true,
        'short_scalar_cast' => true,
        // 'single_blank_line_before_namespace' => true,
        'single_class_element_per_statement' => true,
        'standardize_not_equals' => true,
        'ternary_operator_spaces' => true,
        'trailing_comma_in_multiline' => ['elements' => ['arrays']],
        'trim_array_spaces' => true,
        'unary_operator_spaces' => true,
        'whitespace_after_comma_in_array' => ['ensure_single_space' => true],
        'space_after_semicolon' => true,
        'single_blank_line_at_eof' => false
    ])
    ->setIndent("\t")
    ->setLineEnding("\n")
    ->setFinder($finder)
;