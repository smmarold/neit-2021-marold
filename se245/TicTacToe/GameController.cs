using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace TicTacToe
{
	class GameController
	{
		public List<string> positions = new();
		
		//Build's the game board. Uses the positions list (initialized to spaces in the constructor) to replace with X and O accordingly. 
		private void BuildBoard()
		{
			Console.WriteLine($" " + positions[6] + " " + "|" + " " + positions[7] + " " + "|" + " " + positions[8] + " ");
			Console.WriteLine("---+---+---"); 								
			Console.WriteLine($" " + positions[3] + " " + "|" + " " + positions[4] + " " + "|" + " " + positions[5] + " ");
			Console.WriteLine("---+---+---"); 					
			Console.WriteLine($" " + positions[0] + " " + "|" + " " + positions[1] + " " + "|" + " " + positions[2] + " ");
		}

		//Takes the Player Turn String (X or O) an puts that in the appropriate spot in the position.
		public void UpdateBoard(string playerLetter, string position)
		{
			switch (position)
			{
				case "1":
					positions[0] = playerLetter;
					break;
				case "2":
					positions[1] = playerLetter;
					break;
				case "3":
					positions[2] = playerLetter;
					break;
				case "4":
					positions[3] = playerLetter;
					break;
				case "5":
					positions[4] = playerLetter;
					break;
				case "6":
					positions[5] = playerLetter;
					break;
				case "7":
					positions[6] = playerLetter;
					break;
				case "8":
					positions[7] = playerLetter;
					break;
				case "9":
					positions[8] = playerLetter;
					break;
			}

			//Clearing the console and calling BuildBoard (which will now have the updated positions in the List)
			Console.Clear();
			BuildBoard();
		}

		//Takes Player (X or O) and checks the various win states of the game against that letter. 
		//If no player has one, checks for a tie by checking the List for spaces (no spaces = tie)
		public bool IsGameOver(string playerSign)
		{
			bool gameOver = false;

			//Normally I avoid single lin ifs. But there was a lot of them, and I wanted it to be clean. 
			if (positions[0] == playerSign && positions[1] == playerSign && positions[2] == playerSign) gameOver = true;
			if (positions[3] == playerSign && positions[4] == playerSign && positions[5] == playerSign) gameOver = true;
			if (positions[6] == playerSign && positions[7] == playerSign && positions[8] == playerSign) gameOver = true;
			if (positions[0] == playerSign && positions[3] == playerSign && positions[6] == playerSign) gameOver = true;
			if (positions[1] == playerSign && positions[4] == playerSign && positions[7] == playerSign) gameOver = true;
			if (positions[2] == playerSign && positions[5] == playerSign && positions[8] == playerSign) gameOver = true;
			if (positions[0] == playerSign && positions[4] == playerSign && positions[8] == playerSign) gameOver = true;
			if (positions[2] == playerSign && positions[4] == playerSign && positions[6] == playerSign) gameOver = true;

			if (gameOver)
				Console.WriteLine($"Player {playerSign} Wins!");

			if (!positions.Contains(" ") && !gameOver)
			{
				gameOver = true;
				Console.WriteLine("The Game is a Tie!");
			}

			return gameOver;
		}

		//On creation, Initialize our positions list to a space, and builds the first board
		public GameController()
		{
			for (int i = 0; i < 9; i++)
			{
				positions.Add(" ");
			}
			BuildBoard();
		}
	}
}
