using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Week_6_Lab
{
	class ValidationLibrary
	{
		//Abbreviated State Validator. Currently only checks that the length is 2 characters. Will improve moving forward. 
		//(Or just use a dropdown) 
		public static bool ValidateStateTwoLetters(string state)
		{
			bool result;
			if (state.Length != 2)
			{
				result =  false;
			}
			else
			{
				result =  true;
			}

			return result;
		}

		//Validate Phone Numbers. Currently only accepts one format (xxx-xxx-xxxx). Can update to include other formats, ie (xxx) xxx-xxxx, or just nums. 
		//Possibly add a funtion to format the numbers regardless of what is entered?
		public static bool ValidatePhoneNumber(string num)
		{
			int dashLocation = num.IndexOf("-");
			int lastDashLocation = num.LastIndexOf("-");
			int numLength = num.Length;
			bool result;

			if (dashLocation == 3 && lastDashLocation == 7 && numLength == 12)
			{
				result =  true;
			}
			else
			{
				result =  false;
			}

			return result;
		}
	//in progress rework of phone number validation. Currently always returns false, regardless of input. 
		/*
		public static bool isValidPhoneNumber(string num)
		{
			bool[] resultArray = new bool[num.Length];
			int dashLocation = num.IndexOf("-");
			int lastDashLocation = num.IndexOf("-");

			for (int i = 0; i < num.Length; i++)
			{
				if (char.IsDigit(num[i]) && i != 3 && i != 7)
					resultArray[i] = true;
				
				else 
					resultArray[i] = false;	
			}
			if (dashLocation == 3)
				resultArray[3] = true;

			if (lastDashLocation == 7)
				resultArray[7] = true;

			return resultArray.All(x => x);
		}
		*/

		//Validated a zip. checks length and uses .IsDigitMethod to check if ALL chars are integers.  
		public static bool ValidateZipCode(string zip)
		{
			bool result;
			bool isAllNums = zip.All(char.IsDigit);
			if(zip.Length == 5 && isAllNums)
			{
				result = true;
			}
			else
			{
				result = false;
			}

			return result;
		}

		//Validated an email by looking for the @ symbol, and capturing it's location. Then looks for a "." AFTER the @ symbol. 
		//Can be updated or modified for certain lengths of emails
		public static bool ValidateEmail(string email)
		{
			int atLocation = email.IndexOf("@");
			int periodLocation;
			bool result;

			if (atLocation != -1 && atLocation < email.Length - 2)
			{
				periodLocation = email.IndexOf(".", atLocation + 2);
				if (periodLocation != -1)
				{
					result =  true;
				}
				else
				{
					result =  false;
				}
			}
			else
			{
				result = false;
			}

			return result;
		}

		public static bool IsInstagramURL(string url)
		{
			bool result;
			if (url.ToUpper().Contains("INSTAGRAM.COM/"))
			{
				result = true;
			}
			else
			{
				result = false;
			}

			return result;
		}
	}
}
