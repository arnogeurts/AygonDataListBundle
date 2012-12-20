<?php

namespace Aygon\DataListBundle\DataList\FilterForm\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class FixedValueTransformer implements DataTransformerInterface
{
    /**
     * The fixed value
     * @var mixed
     */
    private $value;
    
    /**
     * Constructor
     * Set the value for the fixed value
     * 
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }
    
    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        return $this->value;
    }
    
    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        return $value;
    }
}