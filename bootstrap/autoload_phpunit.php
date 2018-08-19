<?php
declare(strict_types=1);
class_alias(\PHPUnit\Framework\TestCase::class, 'PHPUnit_Framework_TestCase');
class_alias(\PHPUnit\Framework\Assert::class, 'PHPUnit_Framework_Assert');
class_alias(\PHPUnit\Framework\Constraint\Constraint::class, 'PHPUnit_Framework_Constraint');
class_alias(\PHPUnit\Framework\Constraint\LogicalNot::class, 'PHPUnit_Framework_Constraint_Not');
class_alias(\PHPUnit\Framework\ExpectationFailedException::class, 'PHPUnit_Framework_ExpectationFailedException');

require __DIR__ . '/autoload.php';