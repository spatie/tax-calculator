<?php

declare(strict_types=1);

use Rector\CodingStyle\Rector\ArrowFunction\StaticArrowFunctionRector;
use Rector\CodingStyle\Rector\Assign\SplitDoubleAssignRector;
use Rector\CodingStyle\Rector\Catch_\CatchExceptionNameMatchingTypeRector;
use Rector\CodingStyle\Rector\Closure\StaticClosureRector;
use Rector\CodingStyle\Rector\If_\NullableCompareToNullRector;
use Rector\Config\RectorConfig;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector;
use Rector\TypeDeclaration\Rector\Closure\AddClosureVoidReturnTypeWhereNoReturnRector;

return RectorConfig::configure()
    ->withPaths(['src', 'tests'])
    ->withPhpSets(php82: true)
    ->withPreparedSets(typeDeclarations: true)
    ->withSkip([
        ClosureToArrowFunctionRector::class,
        ReturnNeverTypeRector::class,
        AddClosureVoidReturnTypeWhereNoReturnRector::class,
        StaticClosureRector::class,
        StaticArrowFunctionRector::class,
        SplitDoubleAssignRector::class,
        NullableCompareToNullRector::class,
        CatchExceptionNameMatchingTypeRector::class,
    ]);
