<?php

namespace App\Http\Controllers;

use App\Profites;
use App\Surprise;
use App\User;
use App\UserScore;
use Illuminate\Http\Request;

class GameController extends Controller
{
    const MIN_RAND_MONEY = 1;
    const MAX_RAND_MONEY = 100;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $userScore = User::getUserAllProfites();
        return view('game', ['userScore' => $userScore]);
    }

    /**
     * @return mixed
     */
    public function getProfit()
    {
        $profites = Profites::all();
        return $this->getRandFromArray($profites);
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getRandMoney()
    {
        return random_int(1, 100);
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getRandBonus()
    {
        return random_int(20, 100);
    }

    /**
     * @return mixed
     */
    public function getRandSurprise()
    {
        $surprise = Surprise::all();
        return $this->getRandFromArray($surprise);
    }

    /**
     * @param $arr
     * @return mixed
     */
    public function getRandFromArray($arr)
    {
        return $arr[mt_rand(0, count($arr) - 1)]->id;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getResult()
    {
        $profit_id = $this->getProfit();
        $bounds = $this->getProfiteBounds($profit_id);
        UserScore::saveUserScore($bounds);

        return User::getUserAllProfites();
    }

    /**
     * @param $profit_id
     * @return array
     * @throws \Exception
     */
    public function getProfiteBounds($profit_id)
    {
        $profit = Profites::find($profit_id);
        $profit->bounds = $this->getRandBonus();

        switch ($profit->name) {
            case Profites::PROFIT_MONEY:
                $profit->bounds = $this->getRandMoney();
                return $profit;
            case Profites::PROFIT_BONUS:
                $profit->bounds = $this->getRandBonus();
                return $profit;
            case Profites::PROFIT_SURPRISE:
                $profit->bounds = $this->getRandSurprise();
                return $profit;
            default:
                return $profit;
        }
    }
}
