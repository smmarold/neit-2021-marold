using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Lab_4_SMarold
{
	class BasicTools
	{
		public static void Pause()
		{
			Console.WriteLine("\nPress any key to continue...");
			Console.ReadKey();
		}

		public static bool ValidateStateTwoLetters(string state)
		{
			if (state.Length > 2)
			{
				return false;
			}
			else
			{
				return true;
			}
		}

		public static bool ValidatePhoneNumber(string num)
		{
			int dashLocation = num.IndexOf("-");
			int lastDashLocation = num.LastIndexOf("-");
			int numLength = num.Length;

			if (dashLocation == 3 && lastDashLocation == 7 && numLength == 12)
			{
				return true;
			}
			else
			{
				return false;
			}


		}

		public static bool ValidateZipCode(string zip)
		{
			int intZip;
			bool isNumber = Int32.TryParse(zip, out intZip);

			if(zip.Length == 5 && isNumber)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public static bool ValidateEmail(string email)
		{
			int atLocation = email.IndexOf("@");
			int periodLocation;

			if (atLocation != -1)
			{
				periodLocation = email.IndexOf(".", atLocation+2);
				if (periodLocation != -1)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
	}
}
