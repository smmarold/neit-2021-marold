<?php
    abstract class Account {
        protected $accountId;
        protected $balance;
        protected $startDate;
        
        public function __construct ($id, $b, $sd) {
           // On creation, set the account properties to the passed values
           $this->accountId = $id;
           $this->balance = $b;
           $this->startDate = $sd;
        }
        public function deposit ($amount) {
            // Increases (or decreases in the case of a negative) the balance by the given amount, returns the new amount
            $this->balance += $amount;
            return $this->balance;
        }

        abstract public function withdrawal($amount);
        // this is an abstract method. This method must be defined in all classes
        // that inherit from this class
        public function getStartDate() {
            // Gets the account Start Date
            return $this->startDate;
        }

        public function getBalance() {
            // Gets the accounts balance
            return $this->balance;
        }

        public function getAccountId() {
            // gets the accounts ID
            return $this->accountId;
        }

        protected function getAccountDetails() {
            // populate $str with the account details as an unordered list
            $str = "<ul>";
            $str .= "<li>Account ID: " . $this->getAccountId() . "</li>";
            $str .= "<li>Account Balance: " .  $this->GetBalance() . "</li>";
            $str .= "<li>Account ID: " .  $this->getStartDate() . "</li>";
            $str .= "</ul>";
            return $str;
        }
    }

    class CheckingAccount extends Account {
        const OVERDRAW_LIMIT = -200;

        public function withdrawal($amount) {
            // write code here. Return true if withdrawal goes through; false otherwise
            //For both accounts, this method is more or a check, and makes no changes to the balance. 
            //In our ATM, if the check passses, we simply call deposit and pass a negative value. 
            if($this->balance - $amount < self::OVERDRAW_LIMIT)
                return false;
            else
                return true;
            

        }

        //freebie. I am giving you this code.
        //Thanks -Steve. 
        public function getAccountDetails() {
            $str = "<h2>Checking Account</h2>";
            $str .= parent::getAccountDetails();
            
            return $str;
        }
    }

    class SavingsAccount extends Account {

        public function withdrawal($amount) {
            // Return true if withdrawal goes through; false otherwise
            //For both accounts, this method is a check, and makes no changes to the balance. 
            //In our ATM, if the check passses, we simply call deposit and pass a negative value. 
            if($this->balance - $amount < 0)
                return false;
            else
                return true;
        }

        public function getAccountDetails() {
           // Same as for Checking, except replacing header with Savings. 
           $str = "<h2>Savings Account</h2>";
            $str .= parent::getAccountDetails();
            
            return $str;
        }
    }

    
    //This was testing code. No longer needed  in the ATM. 

    //$checking = new CheckingAccount ('C123', 1000, '12-20-2019');
    // $checking->withdrawal(200);
    // $checking->deposit(500);

    //$savings = new SavingsAccount('S123', 5000, '03-20-2020');
    
    // echo $checking->getAccountDetails();
    // echo $savings->getAccountDetails();
    // echo $checking->getStartDate();
    
?>
