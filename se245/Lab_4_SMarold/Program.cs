/*************************************************************************************************************************************************
 *                                                             Stephen Marold
 *																	Lab 4
 *																	SE245
 *
 *
 *************************************************************************************************************************************************/


using System;

namespace Lab_4_SMarold
{
	class Program
	{
		static void Main(string[] args)
		{
			//Create a new Person object, and declare any variables to be used. 
			Person tempPerson = new Person();
			bool validation;
			string validationCheck;

			Console.WriteLine("Enter the person's first name: ");
			tempPerson.FirstName = Console.ReadLine();

			Console.WriteLine("Enter the person's middle name: ");
			tempPerson.MiddleName = Console.ReadLine();

			Console.WriteLine("Enter the person's last name: ");
			tempPerson.LastName = Console.ReadLine();

			Console.WriteLine("Enter the person's street address: ");
			tempPerson.Street1 = Console.ReadLine();

			Console.WriteLine("Enter the addresses apartment number or department. : ");
			tempPerson.Street2 = Console.ReadLine();

			Console.WriteLine("Enter the city: ");
			tempPerson.City = Console.ReadLine();

			//gather and validate the state requirements, loop until valid. 
			do
			{
				Console.WriteLine("Enter the State (2 letters. Ex. ME): ");
				validationCheck = Console.ReadLine();
				validation = BasicTools.ValidateStateTwoLetters(validationCheck);

				if (validation)
				{
					tempPerson.State = validationCheck.ToUpper();
				}
				else
				{
					Console.WriteLine("Invalid Format. Please try again");
				}

			} while (!validation);


			//gather and validate the zip
			do
			{
				Console.WriteLine("Enter the Zip Code: ");
				validationCheck= Console.ReadLine();
				validation = BasicTools.ValidateZipCode(validationCheck);

				if (validation)
				{
					tempPerson.Zip = validationCheck;
				}
				else
				{
					Console.WriteLine("Invalid Format. Please try again");
				}

			} while (!validation);

			//Gather and validate the phone number format. 
			do
			{
				Console.WriteLine("Enter the person's phone number (Format: xxx-xxx-xxx): ");
				validationCheck = Console.ReadLine();
				validation = BasicTools.ValidatePhoneNumber(validationCheck);

				if (validation)
				{
					tempPerson.Phone = validationCheck;
				}
				else
				{
					Console.WriteLine("Invalid phone number. Please try again");
				}

			} while (!validation);

			//same for email
			do
			{
				Console.WriteLine("Enter the person's email (ex. joe@Shmo.com): ");
				validationCheck = Console.ReadLine();
				validation = BasicTools.ValidateEmail(validationCheck);

				if (validation)
				{
					tempPerson.Email = validationCheck;
				}
				else
				{
					Console.WriteLine("Invalid email. Please try again");
				}

			} while (!validation);

			//print the information gathered back to the user. 
			Console.WriteLine("\n\nHere is the information you entered: ");
			Console.Write($"\nPerson's first name: {tempPerson.FirstName}");
			Console.Write($"\nPerson's middle name: {tempPerson.MiddleName}");
			Console.Write($"\nPerson's last name: {tempPerson.LastName}");
			Console.Write($"\nPerson's street address: {tempPerson.Street1}");
			Console.Write($"\nPerson's apartment/department: {tempPerson.Street2}");
			Console.Write($"\nPerson's city: {tempPerson.City}");
			Console.Write($"\nPerson's state: {tempPerson.State}");
			Console.Write($"\nPerson's zip code: {tempPerson.Zip}");
			Console.Write($"\nPerson's phone number: {tempPerson.Phone}");
			Console.Write($"\nPerson's email: {tempPerson.Email}");

			BasicTools.Pause();
		}
	}
}
