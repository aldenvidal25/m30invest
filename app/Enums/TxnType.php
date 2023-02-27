<?php

namespace App\Enums;

enum TxnType: string
{
    case Deposit = 'deposit';
    case Subtract = 'subtract';
    case ManualDeposit = 'manual_deposit';
    case SendMoney = 'send_money';
    case Exchange = 'exchange';
    case Referral = 'referral';
    case SignupBonus = 'signup_bonus';
    case Bonus = 'bonus';
    case Withdraw = 'Withdraw';
    case ReceiveMoney = 'receive_money';
    case Investment = 'Invest';
    case Interest = 'interest';
    case Refund = 'refund';
}
