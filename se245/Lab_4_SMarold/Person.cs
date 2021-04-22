using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Lab_4_SMarold
{
	public class Person
	{
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
				state = value;
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
				zip = value;
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
				phoneNum = value;
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
				email = value;
			}
		}
	}
}
