<?php 

abstract class Operation {
  protected $operand_1;
  protected $operand_2;

    /**
     * @throws Exception
     */
    public function __construct($o1, $o2 = null) {
        if (!is_numeric($o1) || ($o2 !== null && !is_numeric($o2))) {
            throw new Exception('Non-numeric operand.');
        }

        $this->operand_1 = $o1;
        $this->operand_2 = $o2;
    }
  public abstract function operate();
  public abstract function getEquation(); 
}

// Addition subclass inherits from Operation
class Addition extends Operation {
  public function operate() {
    return $this->operand_1 + $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' + ' . $this->operand_2 . ' = ' . $this->operate();
  }
}


// Add subclasses for Subtraction, Multiplication and Division here
class Subtraction extends Operation {
    public function operate() {
        return $this->operand_1 - $this->operand_2;
    }
    public function getEquation() {
        return $this->operand_1 . ' - ' . $this->operand_2 . ' = ' . $this->operate();
    }
}

class Multiplication extends Operation {
    public function operate() {
        return $this->operand_1 * $this->operand_2;
    }
    public function getEquation() {
        return $this->operand_1 . ' * ' . $this->operand_2 . ' = ' . $this->operate();
    }
}

class Division extends Operation {
    public function operate() {
        return $this->operand_1 / $this->operand_2;
    }
    public function getEquation() {
        return $this->operand_1 . ' / ' . $this->operand_2 . ' = ' . $this->operate();
    }
}

class SquareRoot extends Operation {
    public function operate() {
        return sqrt($this->operand_1);
    }

    public function getEquation() {
        return '√' . $this->operand_1 . ' = ' . $this->operate();
    }
}

class Log10 extends Operation {
    public function operate() {
        return log10($this->operand_1);
    }

    public function getEquation() {
        return 'log(' . $this->operand_1 . ') = ' . $this->operate();
    }
}

class Ln extends Operation {
    public function operate() {
        return log($this->operand_1);
    }

    public function getEquation() {
        return 'ln(' . $this->operand_1 . ') = ' . $this->operate();
    }
}

class Square extends Operation {
    public function operate() {
        return pow($this->operand_1, 2);
    }

    public function getEquation() {
        return $this->operand_1 . '^2 = ' . $this->operate();
    }
}

class Power extends Operation {
    public function operate() {
        return pow($this->operand_1, $this->operand_2);
    }

    public function getEquation() {
        return $this->operand_1 . '^' . $this->operand_2 . ' = ' . $this->operate();
    }
}

class Exponential extends Operation {
    public function operate() {
        return exp($this->operand_1);
    }

    public function getEquation() {
        return 'e^' . $this->operand_1 . ' = ' . $this->operate();
    }
}

class TenPower extends Operation {
    public function operate() {
        return pow(10, $this->operand_1);
    }

    public function getEquation() {
        return '10^' . $this->operand_1 . ' = ' . $this->operate();
    }
}

class Sine extends Operation {
    public function operate() {
        return sin($this->operand_1);
    }

    public function getEquation() {
        return 'sin(' . $this->operand_1 . ') = ' . $this->operate();
    }
}

class Cosine extends Operation {
    public function operate() {
        return cos($this->operand_1);
    }

    public function getEquation() {
        return 'cos(' . $this->operand_1 . ') = ' . $this->operate();
    }
}

class Tangent extends Operation {
    public function operate() {
        return tan($this->operand_1);
    }

    public function getEquation() {
        return 'tan(' . $this->operand_1 . ') = ' . $this->operate();
    }
}



// Some debugs - uncomment these to see what is happening...
// echo '$_POST print_r=>',print_r($_POST);
// echo "<br>",'$_POST vardump=>',var_dump($_POST);
// echo '<br/>$_POST is ', (isset($_POST) ? 'set' : 'NOT set'), "<br/>";
// echo "<br/>---";


// Check to make sure that POST was received 
// upon initial load, the page will be sent back via the initial GET at which time
// the $_POST array will not have values - trying to access it will give undefined message

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $o1 = $_POST['op1'];
    $o2 = $_POST['op2'];
  }
  $err = Array();


// Instantiate an object for each operation based on the values returned on the form
// For example, check to make sure that $_POST is set and then check its value and 
// instantiate its object
// 
// The Add is done below.  Go ahead and finish the remiannig functions.  
// Then tell me if there is a way to do this without the ifs
// We might cover such a way on Tuesday...

try {
    if (isset($_POST['add']) && $_POST['add'] == 'Add') {
        $op = new Addition($o1, $o2);
    } elseif (isset($_POST['sub']) && $_POST['sub'] == 'Subtract') {
        $op = new Subtraction($o1, $o2);
    } elseif (isset($_POST['mult']) && $_POST['mult'] == 'Multiply') {
        $op = new Multiplication($o1, $o2);
    } elseif (isset($_POST['divi']) && $_POST['divi'] == 'Divide') {
        $op = new Division($o1, $o2);
    } elseif (isset($_POST['sqrt']) && $_POST['sqrt'] == 'Square Root') {
        $op = new SquareRoot($o1);
    } elseif (isset($_POST['log10']) && $_POST['log10'] == 'Log(10)') {
        $op = new Log10($o1);
    } elseif (isset($_POST['ln']) && $_POST['ln'] == 'Ln') {
        $op = new Ln($o1);
    } elseif (isset($_POST['x^2']) && $_POST['x^2'] == 'x^2') {
        $op = new Square($o1);
    } elseif (isset($_POST['x^y']) && $_POST['x^y'] == 'x^y') {
        $op = new Power($o1, $o2);
    } elseif (isset($_POST['e^x']) && $_POST['e^x'] == 'e^x') {
        $op = new Exponential($o1);
    } elseif (isset($_POST['10^x']) && $_POST['10^x'] == '10^x') {
        $op = new TenPower($o1);
    } elseif (isset($_POST['sin']) && $_POST['sin'] == 'sin') {
        $op = new Sine($o1);
    } elseif (isset($_POST['cos']) && $_POST['cos'] == 'cos') {
        $op = new Cosine($o1);
    } elseif (isset($_POST['tan']) && $_POST['tan'] == 'tan') {
        $op = new Tangent($o1);
    }

    else {
        throw new Exception('No operation given.');
    }
}

  catch (Exception $e) {
    $err[] = $e->getMessage();
  }
?>

<!doctype html>
<html lang="en">
<head>
    <title>PHP Calculator</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern PHP Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="calculator">
    <h1>PHP Calculator</h1>
    <div id="result" class="result">
  <pre id="result">
  <?php 
    if (isset($op)) {
      try {
        echo $op->getEquation();
      }
      catch (Exception $e) { 
        $err[] = $e->getMessage();
      }
    }

    foreach($err as $error) {
        echo $error . "\n";
    } 
  ?>
  </pre>
    </div>
    <form id="calcForm" method="post" action="calculator.php" class="calc-form">
        <div class="input-group">
            <input type="text" name="op1" id="op1" placeholder="Enter first number" required>
            <input type="text" name="op2" id="op2" placeholder="Enter second number">
        </div>
        <div class="button-group">
            <input type="submit" name="add" value="Add">
            <input type="submit" name="sub" value="Subtract">
            <input type="submit" name="mult" value="Multiply">
            <input type="submit" name="divi" value="Divide">
            <input type="submit" name="sqrt" value="Square Root">
            <input type="submit" name="log10" value="Log(10)">
            <input type="submit" name="ln" value="Ln">
            <br>
            <input type="submit" name="x^2" value="x^2" />
            <input type="submit" name="x^y" value="x^y" />
            <input type="submit" name="e^x" value="e^x" />
            <input type="submit" name="10^x" value="10^x" />
            <input type="submit" name="sin" value="sin" />
            <input type="submit" name="cos" value="cos" />
            <input type="submit" name="tan" value="tan" />
        </div>
    </form>
</div>
</body>
</html>

