using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace TicTacToe
{
	class Player
	{
		List<string> chosenPositions = new();
		
		//Seems simple, but I wanted anything related to the Player in the player class. 
		//Takes the current player and swaps it, returning the opposite player
		public string PlayerTurn(string playerLetter)
		{
			if (playerLetter.Contains("X"))
				playerLetter = "O";
			else
				playerLetter = "X";

			return playerLetter;
		}

		public string GetPlayerChoice()
		{
			//Set up CKI for reading key, choice var, and while loop var
			ConsoleKeyInfo cki;
			string playerChoice = "";
			bool validChoice = false;

			while (!validChoice)
			{
				//get the key from the player
				cki = Console.ReadKey();
				playerChoice = cki.Key.ToString().Substring(cki.Key.ToString().Length - 1, 1);

				//If it is NOT a digit and NOT the Esc Key, or if it's already in our choices made List, error out, try again
				if ((!Char.IsDigit(playerChoice[0]) && cki.Key != ConsoleKey.Escape) || chosenPositions.Contains(playerChoice))
				{
					Console.WriteLine("\nInvalid Selection. Try Again.");
				}
				else if (Char.IsDigit(playerChoice[0])) //if digit, add to selections, break out of loop
				{
					chosenPositions.Add(playerChoice);
					validChoice = true;

				}
				else
				{
					validChoice = true; //if escape, break out of loop
				}
			}

			return playerChoice;
		}
	}
}
