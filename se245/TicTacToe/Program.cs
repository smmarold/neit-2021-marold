/* Tic Tac Toe Version 1. 
 * Really proud of this. First program of this size that I built with no tutorials, no example code, etc. Just figured it out. 
 * Spent a lot of time refactoring. Main was a mess until I moved a ton of code into Player and GC objects, 
 * The lesson being, I think, try to better plan out where each job or function should go before writing, will make it easier in the long run.
 * In fact, more time was spent trying to refactor and optimize than writing the initial code. Moving PlayerChoice into Player was kind of a mess
 * at first. Second lesson would be don't jump to more complicated stuff if an easier way exists. I had a 2D (3x3) Array for the game positions
 * before realizing a single List would do the exact same thing, which I eventually did. 
 * 
 * Only thing I MAY change with V1 is adding the numbers to the cells so players can easily understand which number corresponds to which cell. 
 *	But right not that breaks my tie-checker, so I'm leaving it for now.
 *	
 * For V2 (If I ever do it): Add a choice between a 1 or 2 player game. With the intention of setting up a VERY basic AI for single player. 
 * TTT is easy enough in theory to tell the AI where it should play its turn. 
 * 
 * For V3(REALLY stretching here): Remove the basic AI, and see if I can get an AI to LEARN how to play the game. Yeah, I know....this is like...WAY more 
 * complicated than the game itself. Maybe by the time I get to it, I'll have a far better understanding of how I might even approach it. */
using System;
using System.Collections.Generic;

namespace TicTacToe
{
	class Program
	{
		static void Main(string[] args)
		{
			//Set up window, initial game objects
			Console.Title = "Tic-Tac-Toe";
			Player player = new Player();
			GameController gameController = new(); //constructor will automatically build a new empty gameBoard. 

			//Variables and such
			bool gameOver = false;
			string whoseTurnIsIt = "O";
			string playerSelection;

			while (!gameOver)
			{
				//Get/Change Player turn. Write relevant info. 
				whoseTurnIsIt = player.PlayerTurn(whoseTurnIsIt);
				Console.WriteLine($"\nIt is now {whoseTurnIsIt}'s turn.");
				Console.WriteLine("Make a Selection (1-9), or Press Escape to Exit. ");

				//Get the player's choice for position, or if they chose escape
				playerSelection = player.GetPlayerChoice();

				//player choice at this point will ALWAYS be a digit or escape. Digits will trigger UpdateBoard with
				//the player and the position. if not digit, can only be escape, and exits the game loop. 
				if (Char.IsDigit(playerSelection[0]))
					gameController.UpdateBoard(whoseTurnIsIt, playerSelection);
				else
					gameOver = true;

				//Does a quick check to see if the player hit escape (if they did and we didn't check first, may inadvertently keep game loop going)
				if (!gameOver)
					gameOver = gameController.IsGameOver(whoseTurnIsIt);
			}

			//Just keeps the game screen up so we can see the results. 
			Console.WriteLine("\nPress Any Key to Exit...");
			Console.ReadKey();
		}
	}
}
