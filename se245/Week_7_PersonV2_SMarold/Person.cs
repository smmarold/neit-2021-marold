using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Week_6_Lab
{
	public class Person
	{
		//Basic Personal Info typical of forms. Includes a Feedback property for error checking. 
		private string fName;
		private string mName;
		private string lName;
		private string street1;
		private string street2;
		private string city;
		private string state;
		private string zip;
		private string phoneNum;
		private string email;
		private string feedback;

		//Gets and Sets. Sets that require validation call the functions from the Validation Library,
		//will also store any errors in the Feedback property as "ERROR: ....." allowing for easy checking in Main
		public string FirstName
		{
			get
			{
				return fName;
			}

			set
			{
				fName = value;
			}
		}

		public string MiddleName
		{
			get
			{
				return mName;
			}

			set
			{
				mName = value;
			}
		}

		public string LastName
		{
			get
			{
				return lName;
			}

			set
			{
				lName = value;
			}
		}

		public string Street1
		{
			get
			{
				return street1;
			}

			set
			{
				street1 = value;
			}
		}

		public string Street2
		{
			get
			{
				return street2;
			}

			set
			{
				street2 = value;
			}
		}

		public string City
		{
			get
			{
				return city;
			}

			set
			{
				city = value;
			}
		}

		public string State
		{
			get
			{
				return state;
			}

			set
			{
				if (ValidationLibrary.ValidateStateTwoLetters(value.ToUpper()))
				{
					state = value;
				}
				else
				{
					Feedback += "ERROR: Invalid State\n";
				}
			}
		}

		public string Zip
		{
			get
			{
				return zip;
			}

			set
			{
				if (ValidationLibrary.ValidateZipCode(value))
				{
					zip = value;
				}
				else
				{
					Feedback += "ERROR: Invalid Zip Code\n";
				}
			}
		}

		public string Phone
		{
			get
			{
				return phoneNum;
			}

			set
			{	
				if (ValidationLibrary.ValidatePhoneNumber(value))
				{
					phoneNum = value;
				}
				else
				{
					Feedback += "ERROR: Invalid Phone Number\n";
				}
			}
		}

		public string Email
		{
			get
			{
				return email;
			}

			set
			{
				if (ValidationLibrary.ValidateEmail(value))
				{
					email = value;
				}
				else
				{
					Feedback += "ERROR: Invalid Email\n";
				}
			}
		}

		public string Feedback
		{
			get
			{
				return feedback;
			}

			set
			{
				feedback = value;
			}
		}

		public Person()
		{
			fName = "";
			mName = "";
			lName = "";
			street1 = "";
			street2 = "";
			city = "";
			state = "";
			zip = "";
			phoneNum = "";
			email = "";
			feedback = "";
		}
	}
}
