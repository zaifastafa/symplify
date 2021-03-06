<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitStrictFixer;
use SlevomatCodingStandard\Sniffs\Exceptions\ReferenceThrowableOnlySniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\Configuration\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::SETS, [
        SetList::PHP_70,
        SetList::PHP_71,
        SetList::CLEAN_CODE,
        SetList::SYMPLIFY,
        SetList::SYMPLIFY,
        SetList::COMMON,
        SetList::PSR_12,
        SetList::DEAD_CODE,
    ]);

    $parameters->set(Option::PATHS, [__DIR__ . '/packages', __DIR__ . '/tests', __DIR__ . '/ecs.php']);

    $parameters->set(Option::EXCLUDE_PATHS, [
        '*/Fixture/*',
        '*/Source/*',
        __DIR__ . '/packages/easy-coding-standard/compiler/build/scoper.inc.php',
        __DIR__ . '/packages/easy-hydrator/tests/Fixture/TypedProperty.php',
        __DIR__ . '/packages/easy-hydrator/tests/TypedPropertiesTest.php',
    ]);

    $parameters->set(Option::SKIP, [
        ArrayDeclarationSniff::class => null,
        BlankLineAfterOpeningTagFixer::class => null,
        UnaryOperatorSpacesFixer::class => null,
        PhpUnitStrictFixer::class => [
            __DIR__ . '/packages/easy-coding-standard/tests/Indentation/IndentationTest.php',
            __DIR__ . '/packages/set-config-resolver/tests/ConfigResolver/SetAwareConfigResolverTest.php',
        ],
        ReferenceThrowableOnlySniff::class . '.ReferencedGeneralException' => [
            __DIR__ . '/packages/coding-standard/src/Rules/NoDefaultExceptionRule.php',
        ],
        ParameterTypeHintSniff::class . '.MissingNativeTypeHint' => [
            '*Sniff.php',
            '*YamlFileLoader.php',
            __DIR__ . '/packages/package-builder/src/Reflection/PrivatesCaller.php',
        ],
    ]);
};
