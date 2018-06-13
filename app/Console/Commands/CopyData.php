<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Mtg\Entities\MtgCard;
use DB;
use Modules\Mtg\Entities\MtgCardOwned;
use Modules\Mtg\Entities\MtgCardSet;
use Modules\Mtg\Entities\MtgCondition;
use Modules\Mtg\Entities\MtgSymbol;

class CopyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CopyData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy data from normal table to eloquent model';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->copy_cards();
        $this->copy_card_owneds();
        $this->copy_card_set();
        $this->copy_conditions();
        $this->copy_symbols();
    }

    public function copy_cards(){
        DB::table('mtg_cards')->truncate();
        $cards = DB::table('card')->get();
        foreach ($cards as $card){
            $new_card = new MtgCard;
            $new_card->front = $card->front;
            $new_card->back = $card->back;
            $new_card->rarity = $card->rarity;
            $new_card->artist = $card->artist;
            $new_card->cardBorder = $card->cardBorder;
            $new_card->cardColourIdentity = $card->cardColourIdentity;
            $new_card->cardColours = $card->cardColours;
            $new_card->cardFlavour = $card->cardFlavour;
            $new_card->cardId = $card->cardId;
            $new_card->cardLayout = $card->cardLayout;
            $new_card->cardLoyalty = $card->cardLoyalty;
            $new_card->cardManaCost = $card->cardManaCost;
            $new_card->cardMultiverseId = $card->cardMultiverseId;
            $new_card->cardName = $card->cardName;
            $new_card->cardNames = $card->cardNames;
            $new_card->cardNumber = $card->cardNumber;
            $new_card->cardOriginalText = $card->cardOriginalText;
            $new_card->cardPower = $card->cardPower;
            $new_card->cardPrintings = $card->cardPrintings;
            $new_card->cardReleaseDate = $card->cardReleaseDate;
            $new_card->cardSet = $card->cardSet;
            $new_card->cardSetName = $card->cardSetName;
            $new_card->cardSubTypes = $card->cardSubTypes;
            $new_card->cardSuperTypes = $card->cardSuperTypes;
            $new_card->cardText = $card->cardText;
            $new_card->cardToughness = $card->cardToughness;
            $new_card->cardType = $card->cardType;
            $new_card->cardTypes = $card->cardTypes;
            $new_card->cardVariations = $card->cardVariations;
            $new_card->cardWatermark = $card->cardWatermark;
            $new_card->cardIsReserved = $card->cardIsReserved;
            $new_card->cardIsStarter = $card->cardIsStarter;
            $new_card->cardIsTimeshifted = $card->cardIsTimeshifted;
            $new_card->isToken = $card->isToken;
            $new_card->cardPrice = $card->cardPrice;
            $new_card->qty = $card->qty;

            if($new_card->save()){
                echo " Copied row number: " . $new_card->id;
            }
        }
    }

    public function copy_card_owneds(){
        DB::table('mtg_card_owneds')->truncate();
        $rows = DB::table('cardowned')->get();
        foreach ($rows as $row){
            $new_row = new MtgCardOwned;
            $new_row->cardid = $row->cardid;
            $new_row->conditionid = $row->conditionid;
            $new_row->value = $row->value;

            if($new_row->save()){
                echo " Copied row number: " . $new_row->id;
            }
        }
    }

    public function copy_card_set(){
        DB::table('mtg_card_sets')->truncate();
        $rows = DB::table('cardset')->get();
        foreach ($rows as $row){
            $new_row = new MtgCardSet;
            $new_row->block = $row->block;
            $new_row->border = $row->border;
            $new_row->code = $row->code;
            $new_row->gathererCode = $row->gathererCode;
            $new_row->infoCode = $row->infoCode;
            $new_row->name = $row->name;
            $new_row->oldCode = $row->code;
            $new_row->oldCode = $row->oldCode;
            $new_row->onlineOnly = $row->onlineOnly;
            $new_row->releaseDate = $row->releaseDate;
            $new_row->type = $row->type;
            $new_row->cardCount = $row->cardCount;
            $new_row->CommonCount = $row->CommonCount;
            $new_row->UnCommonCount = $row->UnCommonCount;
            $new_row->RareCount = $row->RareCount;
            $new_row->MythicCount = $row->MythicCount;
            $new_row->BasicLandCount = $row->BasicLandCount;
            $new_row->SpecialCount = $row->SpecialCount;
            $new_row->TokenCount = $row->TokenCount;
            $new_row->cardSetPrice = $row->cardSetPrice;

            if($new_row->save()){
                echo " Copied row number: " . $new_row->id;
            }
        }
    }

    public function copy_conditions(){
        DB::table('mtg_conditions')->truncate();
        $rows = DB::table('condition')->get();
        foreach ($rows as $row){
            $new_row = new MtgCondition;
            $new_row->grade = $row->grade;
            $new_row->name = $row->name;
            $new_row->description = $row->description;
            $new_row->frontimage = $row->frontimage;
            $new_row->backimage = $row->backimage;

            if($new_row->save()){
                echo " Copied row number: " . $new_row->id;
            }
        }
    }

    public function copy_symbols(){
        DB::table('mtg_symbols')->truncate();
        $rows = DB::table('symbol')->get();
        foreach ($rows as $row){
            $new_row = new MtgSymbol;
            $new_row->name = $row->name;
            $new_row->description = $row->description;
            $new_row->image = $row->image;
            $new_row->symboltext = $row->symboltext;
            $new_row->nosymbolinfo = $row->nosymbolinfo;
            $new_row->nosymbolimage = $row->nosymbolimage;

            if($new_row->save()){
                echo " Copied row number: " . $new_row->id;
            }
        }
    }
}
