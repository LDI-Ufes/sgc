<?php

namespace Tests\Unit;

use App\Helpers\TextHelper;
use PHPUnit\Framework\TestCase;

class TextHelperTest extends TestCase
{
    /**
     * Test titleCase helper function works
     *
     * @return void
     */
    public function testTitleCaseHelper()
    {
        $this->assertEquals(TextHelper::titleCase('king henry viii'), 'King Henry VIII');
        $this->assertEquals(TextHelper::titleCase('dom joão vi'), 'Dom João VI');
        $this->assertEquals(TextHelper::titleCase('dona maria ii'), 'Dona Maria II');
    }

    /**
     * Test removeAccent helper function can deal
     * with Portuguese characters
     *
     * @return void
     */
    public function testRemoveAccentHelper()
    {
        $this->assertEquals(
            TextHelper::removeAccents('Açalpão, Caçapa, Época, Açaí'),
            'Acalpao, Cacapa, Epoca, Acai'
        );

        $this->assertEquals(TextHelper::removeAccents('áéíóúÁÉÍÓÚ'), 'aeiouAEIOU');
        $this->assertEquals(TextHelper::removeAccents('àãÀÃçÇ'), 'aaAAcC');
    }
}
