<?php

namespace Doctrine\DBAL\Schema;

use function in_array;

/**
 * Represents the change of a column.
 *
 * @link   www.doctrine-project.org
 */
class ColumnDiff
{
    /** @var string */
    public $oldColumnName;

    /** @var Column */
    public $column;

    /** @var array */
    public $changedProperties = [];

    /** @var Column */
    public $fromColumn;

    /**
     * @param string   $oldColumnName
     * @param string[] $changedProperties
     */
    public function __construct($oldColumnName, Column $column, array $changedProperties = [], ?Column $fromColumn = null)
    {
        $this->oldColumnName     = $oldColumnName;
        $this->column            = $column;
        $this->changedProperties = $changedProperties;
        $this->fromColumn        = $fromColumn;
    }

    /**
     * @param string $propertyName
     *
     * @return bool
     */
    public function hasChanged($propertyName)
    {
        return in_array($propertyName, $this->changedProperties);
    }

    /**
     * @return Identifier
     */
    public function getOldColumnName()
    {
        $quote = $this->fromColumn && $this->fromColumn->isQuoted();

        return new Identifier($this->oldColumnName, $quote);
    }
}
