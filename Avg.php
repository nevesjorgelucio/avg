<?php

class Avg
{
    const MIN = 2;

    private $numbers;

    public function __construct(array $numbers)
    {
        $this->numbers = $numbers;
    }

    public function getNumbers()
    {
        return $this->numbers;
    }

    public function calculate()
    {
        try {
            $this->validate();
        } catch (InvalidArgumentException $e) {
            return sprintf('Invalid Argument Exception: %s', $e->getMessage());
        } catch (Exception $e) {
            return $e->getMessage();
        }
        $sum = array_sum($this->getNumbers());
        $count = count($this->getNumbers());
        $result = $sum / $count;

        return $result;
    }

    private function validate()
    {
        if (! is_array($this->getNumbers())) {
            throw new InvalidArgumentException(
                sprintf('Numbers is not a array: %s', json_encode($this->getNumbers()))
            );
        }

        if (self::MIN > count($this->getNumbers())) {
            throw new InvalidArgumentException(
                sprintf('The quantity of numbers is not valid: %d', count($this->getNumbers()))
            );
        }
        array_walk($this->getNumbers(), function ($n) {
            if (! is_int($n)) {
                throw new InvalidArgumentException(
                    sprintf('The %s is not a integer', json_encode($n))
                );
            }
        });
    }
}
$avg = new Avg([12, 8]);
$result = $avg->calculate();
var_dump($result);