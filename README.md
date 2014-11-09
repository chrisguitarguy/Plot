# Plot

A scheme written in PHP for no good reason.

## Example

```php

use Chrisguitarguy\Plot\Plot;

$prog = <<<EOF
(define say-hello! (lambda (name) (println! "Hello," name)))
(say-hello! "Plot")
(+ 1 2 3)
EOF;

$plot = new Plot();

$result = $plot->evaluateString($prog);
var_dump($result); // int(6), the result of the last s-expression is returned
```
