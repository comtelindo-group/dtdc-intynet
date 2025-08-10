<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get the current enum values from the database
        $tableName = 'volunteers';
        $columnName = 'status';
        
        // Get current enum values
        $enumValues = $this->getEnumValues($tableName, $columnName);
        
        // Add the new value if it doesn't exist
        if (!in_array('Pemasangan Banner', $enumValues)) {
            $enumValues[] = 'Pemasangan Banner';
            
            // Create the new enum constraint
            $enumString = "'" . implode("','", $enumValues) . "'";
            
            DB::statement("ALTER TABLE {$tableName} MODIFY COLUMN {$columnName} ENUM({$enumString})");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Get the current enum values from the database
        $tableName = 'volunteers';
        $columnName = 'status';
        
        // Get current enum values
        $enumValues = $this->getEnumValues($tableName, $columnName);
        
        // Remove the new value if it exists
        if (in_array('Pemasangan Banner', $enumValues)) {
            $enumValues = array_filter($enumValues, function($value) {
                return $value !== 'Pemasangan Banner';
            });
            
            // Recreate the enum constraint without the new value
            $enumString = "'" . implode("','", $enumValues) . "'";
            
            DB::statement("ALTER TABLE {$tableName} MODIFY COLUMN {$columnName} ENUM({$enumString})");
        }
    }

    /**
     * Get enum values from database
     */
    private function getEnumValues($tableName, $columnName): array
    {
        $result = DB::select("
            SELECT COLUMN_TYPE 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = ? 
            AND COLUMN_NAME = ?
        ", [$tableName, $columnName]);

        if (empty($result)) {
            return [];
        }

        $enumString = $result[0]->COLUMN_TYPE;
        
        // Extract enum values from string like "enum('value1','value2')"
        preg_match("/^enum\((.*)\)$/", $enumString, $matches);
        
        if (empty($matches[1])) {
            return [];
        }

        // Split and clean the values
        $values = explode(',', $matches[1]);
        return array_map(function($value) {
            return trim($value, "'");
        }, $values);
    }
};
