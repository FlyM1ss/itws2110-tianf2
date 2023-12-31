<?php
// calculator_main.php

function calculateExpression($expression) {
  // Check for square root operation
  if (preg_match('/sqrt\((-?\d+\.?\d*)\)/', $expression, $matches)) {
    $operand = floatval($matches[1]);
    return sqrt($operand);
  }
  // Check for log base 10 operation
  elseif (preg_match('/log\((-?\d+\.?\d*)\)/', $expression, $matches)) {
    $operand = floatval($matches[1]);
    return log10($operand);
  }
  // Check for natural logarithm operation
  elseif (preg_match('/ln\((-?\d+\.?\d*)\)/', $expression, $matches)) {
    $operand = floatval($matches[1]);
    return log($operand);
  }
  // Check for basic operations (addition, subtraction, multiplication, division)
  elseif (preg_match('/(-?\d+\.?\d*)\s*([\+\-\*\/])\s*(-?\d+\.?\d*)/', $expression, $matches)) {
    $operand1 = floatval($matches[1]);
    $operator = $matches[2];
    $operand2 = floatval($matches[3]);

    switch ($operator) {
      case '+':
        return $operand1 + $operand2;
      case '-':
        return $operand1 - $operand2;
      case '*':
        return $operand1 * $operand2;
      case '/':
        if ($operand2 == 0) {
          return "Error: Cannot divide by zero";
        }
        return $operand1 / $operand2;
      default:
        return "Error: Unsupported operator '$operator'";
    }
  } else {
    return "Error: Invalid expression format";
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $expression = $_POST['expression'];
  echo calculateExpression($expression);
}
