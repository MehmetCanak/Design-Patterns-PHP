<?php 
declare(strict_types=1);

namespace App\Strategy;

class Product
{
    private string $name;

    private string $category;

    private float $price;

    private float $taxes;

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return Product
     */
    public function setCategory(string $category): Product
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Product
     */
    public function setPrice(float $price): Product
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxes(): float
    {
        return $this->taxes;
    }

    /**
     * @param float $taxes
     * @return Product
     */
    public function setTaxes(float $taxes): Product
    {
        $this->taxes = $taxes;
        return $this;
    }
}
/**
 * Interface TaxCalculatorStrategy
 * @package App\Strategy
 */
interface TaxCalculatorStrategy
{
    /**
     * @param Product $product
     * @return float
     */
    public function calculate(Product $product): float;
}

class ElectronicTaxStrategy implements TaxCalculatorStrategy
{
    const TAX_RATE = 40.0;

    /**
     * @param Product $product
     * @return float
     */
    public function calculate(Product $product): float
    {
        return $product->getPrice() * (self::TAX_RATE / 100);
    }
}

class TaxFreeStrategy implements TaxCalculatorStrategy
{
    public function calculate(Product $product): float
    {
        return 0;
    }
}
class FoodTaxStrategy implements TaxCalculatorStrategy
{
    const TAX_RATE = 30.0;

    /**
     * @param Product $product
     * @return float
     */
    public function calculate(Product $product): float
    {
        return $product->getPrice() * (self::TAX_RATE / 100);
    }
}

class Context
{
    /**
     * @var TaxCalculatorStrategy
     */
    private TaxCalculatorStrategy $taxCalculatorStrategy;

    /**
     * Context constructor.
     * @param TaxCalculatorStrategy $taxCalculatorStrategy
     */
    public function __construct(TaxCalculatorStrategy $taxCalculatorStrategy)
    {
        $this->taxCalculatorStrategy = $taxCalculatorStrategy;
    }

    public function calculateProduct(Product $product): void
    {
        $taxes = $this->taxCalculatorStrategy->calculate($product);

        $product->setTaxes($taxes);
    }
}
/// -----------------------------    Factories  -----------------------------------------------------

interface CalculatorFactory
{
    public function make(): TaxCalculatorStrategy;
}

class ElectronicTaxStrategyFactory implements CalculatorFactory
{
    public function make(): TaxCalculatorStrategy
    {
        return new ElectronicTaxStrategy();
    }
}

class TaxFreeStrategyFactory implements CalculatorFactory
{
    public function make(): TaxCalculatorStrategy
    {
        return new TaxFreeStrategy();
    }
}

class FoodTaxStrategyFactory implements CalculatorFactory
{
    public function make(): TaxCalculatorStrategy
    {
        return new FoodTaxStrategy();
    }
}

function clientCode(CalculatorFactory $factory)
{
    $product = new Product();
    $product->setCategory('electronic');
    $product->setPrice(100);

    $strategy = $factory->make();
    echo "price : " .$price = $strategy->calculate($product);
}


clientCode(new ElectronicTaxStrategyFactory());

// function clientCodeStrategyPattern(CalculatorFactory $creator)
// {
//     $context = new Context($creator->make());

//     $product = new Product();
//     $product->setCategory('electronic');
//     $product->setPrice(100);

//     echo "calculate : ". $context->calculateProduct($product);
// }








