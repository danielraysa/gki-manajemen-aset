<?php

	// Set namespace (works only with PHP 5.3)
	namespace TestProject;

	// This prints file full path and name
	echo "This file full path and file name is '" . __FILE__ . "'.\n";

	// This prints file full path, without file name
	echo "This file full path is '" . __DIR__ . "'.\n";

	// This prints current line number on file
	echo "This is line number " . __LINE__ . ".\n";

	// Really simple basic test function
	function test_function_magic_constant() {
		echo "This is from '" . __FUNCTION__ . "' function.\n";
	}

	// Prints function and used namespace
	test_function_magic_constant();

	// Really simple class for testing magic constants
	class TestMagicConstants {
		// Prints class name
		public function printClassName() {
			echo "This is " . __CLASS__ . " class.\n";
		}

		// Prints class and method name
		public function printMethodName() {
			echo "This is " . __METHOD__ . " method.\n";
		}

		// Prints function name
		public function printFunction() {
			echo "This is function '" . __FUNCTION__ . "' inside class.\n";
		}

		// Prints namespace name (works only with PHP 5.3)
		public function printNamespace() {
			echo "Namespace name is '" . __NAMESPACE__ . "'.\n";
		}
	}

	// Create new TestMagicConstants class
	$test_magic_constants = new TestMagicConstants;

	// This prints class name and used namespace
	$test_magic_constants->printClassName();

	// This prints method name and used namespace
	$test_magic_constants->printMethodName();

	// This prints function name inside class and used namespace
	// same as method name, but without class
	$test_magic_constants->printFunction();

	// This prints namespace name (works only with PHP 5.3)
	$test_magic_constants->printNamespace();

?>