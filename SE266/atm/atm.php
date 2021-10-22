<?php 
    include('account.php');

    //Initialize a var for storing messages to user if needed. 
    $insuffFunds = '';

    if (isset ($_POST['checkWithdrawSubmit'])) { 
        //On withdraw from checking, grab amount and current balance from inputs, instantiate new accounts objs.
        $amount = filter_input(INPUT_POST, 'checkWithdrawAmt', FILTER_VALIDATE_FLOAT);
        $checkBalance = filter_input(INPUT_POST, 'checkingBalance');
        $savingsBalance = filter_input(INPUT_POST, 'savingsBalance');
        $checkingAccount = new CheckingAccount('C487', $checkBalance, '12-20-2020');
        $savingsAccount = new SavingsAccount('S120', $savingsBalance, '12-20-2020');

        // using withdrawal method, if we have enough funds, perform the calc, and store as new balance. 
        // else, we populate our message var with an "insufficient funds" message.
        if($checkingAccount->withdrawal($amount))
            $checkBalance = $checkingAccount->deposit(-$amount);
        else
            $insuffFunds .= "<p class='error'>Error: Insufficient Funds<p>";
    } else if (isset ($_POST['checkDepositSubmit'])) { 
        //On deposit, we get the posted amount and current balance, create new account obj, and call deposit again for a new amount.
        $amount = filter_input(INPUT_POST, 'checkDepositAmt', FILTER_VALIDATE_FLOAT);
        $checkBalance = filter_input(INPUT_POST, 'checkingBalance');
        $savingsBalance = filter_input(INPUT_POST, 'savingsBalance');
        $checkingAccount = new CheckingAccount('C487', $checkBalance, '12-20-2020');
        $savingsAccount = new SavingsAccount('S120', $savingsBalance, '12-20-2020');
        $checkBalance = $checkingAccount->deposit($amount);
    } else if (isset ($_POST['savingsWithdrawSubmit'])) {
        //On withdraw from Savings, grab amount and current balance from inputs, instantiate new accounts objs.
        $amount = filter_input(INPUT_POST, 'savingsWithdrawAmt', FILTER_VALIDATE_FLOAT);
        $checkBalance = filter_input(INPUT_POST, 'checkingBalance');
        $savingsBalance = filter_input(INPUT_POST, 'savingsBalance');
        $checkingAccount = new CheckingAccount('C487', $checkBalance, '12-20-2020');
        $savingsAccount = new SavingsAccount('S120', $savingsBalance, '12-20-2020');

        // using withdrawal method, if we have enough funds, perform the calc, and store as new balance. 
        // else, we populate our message var with an "insufficient funds" message.
        if($savingsAccount->withdrawal($amount))
            $savingsBalance = $savingsAccount->deposit(-$amount);
        else
            $insuffFunds .= "<p class='error'>Error: Insufficient Funds<p>";
    } else if (isset ($_POST['savingsDepositSubmit'])) {
        //On deposit, we get the posted amount and current balance, create new account obj, and call deposit again for a new amount.
        $amount = filter_input(INPUT_POST, 'savingsDespositAmt', FILTER_VALIDATE_FLOAT);
        $checkBalance = filter_input(INPUT_POST, 'checkingBalance');
        $savingsBalance = filter_input(INPUT_POST, 'savingsBalance');
        $checkingAccount = new CheckingAccount('C487', $checkBalance, '12-20-2020');
        $savingsAccount = new SavingsAccount('S120', $savingsBalance, '12-20-2020');
        $savingsBalance = $savingsAccount->deposit($amount);
    } else {
        //Initial page load. Create vars and instance of accounts. 
        $checkBalance = 1000;
        $savingsBalance = 500;
        $checkingAccount = new CheckingAccount('C487', $checkBalance, '12-20-2020');
        $savingsAccount = new SavingsAccount('S120', $savingsBalance, '12-20-2020');
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM Simulator</title>
    <style>
        .container {
            display: grid;
            grid-template-columns: 400px 400px;
        }

        .accounts {
            border: 1px solid black;
        }

        .input {
            padding: 5px;
        }
        .error{
            color:red;
        }
    </style>
</head>
<body>
    <?= $insuffFunds;?> <!-- If this var is populated, we display it. Displays when a user tried to withdraw more than the allotted amount. -->
    <form action="atm.php" method="post">
        <div class="container">
            <div class="accounts">
                <h2>Checking Account</h2>
                <!-- This is a hidden input used to store the current account balance once we submit. -->
                <input type="hidden" name="checkingBalance" value="<?= $checkingAccount->getBalance(); ?>" />
                <ul>
                    <!-- Populating the relevant fields with the getters from the objects. -->
                    <li>Account ID: <?= $checkingAccount->getAccountId(); ?></li>
                    <li>Balance: $<?= $checkBalance ?></li>
                    <li>Account Created: <?= $checkingAccount->getAccountId(); ?></li>
                    <div class="input">
                        <input type="text" name="checkWithdrawAmt" />
                        <input type="submit" name="checkWithdrawSubmit" value="Withdraw"/>
                    </div>
                    <div class="input">
                        <input type="text" name="checkDepositAmt" />
                        <input type="submit" name="checkDepositSubmit" value="Deposit"/>
                    </div>
                </ul>
            </div>
            <div class="accounts">
                <h2>Savings Account</h2>
                <!-- This is a hidden input used to store the current account balance once we submit. -->
                <input type="hidden" name="savingsBalance" value="<?= $savingsAccount->getBalance(); ?>" />
                <ul>
                    <!-- Populating the relevant fields with the getters from the objects. -->
                    <li>Account ID: <?= $savingsAccount->getAccountId(); ?></li>
                    <li>Balance: $<?= $savingsBalance ?></li>
                    <li>Account Created: <?= $savingsAccount->getAccountId(); ?></li>
                    <div class="input">
                        <input type="text" name="savingsWithdrawAmt" />
                        <input type="submit" name="savingsWithdrawSubmit" value="Withdraw"/>
                    </div>
                    <div class="input">
                        <input type="text" name="savingsDespositAmt" />
                        <input type="submit" name="savingsDepositSubmit" value="Desposit"/>
                    </div>
                </ul>
            </div>
        </div>
    </form>
</body>
</html>