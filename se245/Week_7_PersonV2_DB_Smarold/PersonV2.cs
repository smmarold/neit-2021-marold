using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data;
using System.Data.SqlClient;

namespace Week_6_Lab
{
	class PersonV2 : Person
	{
		private string cellPhone;
		private string instagramURL;
		
		public string CellPhone
		{
			get
			{
				return cellPhone;
			}
			set
			{
				if (ValidationLibrary.ValidatePhoneNumber(value))
				{
					cellPhone = value;
				}
				else
				{
					Feedback += "ERROR: Invalid Cell Phone Number\n";
				}
			}
		}

		public string InstagramURL
		{
			get
			{
				return instagramURL;
			}
			set
			{
				if (ValidationLibrary.IsInstagramURL(value))
				{
					instagramURL = value;
				}
				else
				{
					Feedback += "ERROR: Invalid IG URL. ex instagram.com/user_name";
				}
			}
		}

		public PersonV2() : base()
		{
			cellPhone = "";
			instagramURL = "";
		}

		public string AddARecord()
		{
			string strResult = "";

			SqlConnection Connection = new SqlConnection();

			Connection.ConnectionString = @"Server=sql.neit.edu\studentsqlserver,4500;Database=SE245_SMarold;User Id=SE245_SMarold;Password=001226919;";

			string strSQL = "INSERT INTO PersonV2 (FirstName, MiddleName, LastName, Phone, Email, Street1, Street2, City, State, Zip, CellPhone, InstagramURL) VALUES (@FirstName, @MiddleName, @LastName, @Phone, @Email, @Street1, @Street2, @City, @State, @Zip, @CellPhone, @InstagramURL)";

			SqlCommand command = new SqlCommand();
			command.CommandText = strSQL;
			command.Connection = Connection;

			command.Parameters.AddWithValue("@FirstName", FirstName);
			command.Parameters.AddWithValue("@MiddleName", MiddleName);
			command.Parameters.AddWithValue("@LastName", LastName);
			command.Parameters.AddWithValue("@Phone", Phone);
			command.Parameters.AddWithValue("@Email", Email);
			command.Parameters.AddWithValue("@Street1", Street1);
			command.Parameters.AddWithValue("@Street2", Street2);
			command.Parameters.AddWithValue("@City", City);
			command.Parameters.AddWithValue("@State", State);
			command.Parameters.AddWithValue("@Zip", Zip);
			command.Parameters.AddWithValue("@CellPhone", CellPhone);
			command.Parameters.AddWithValue("@InstagramURL", InstagramURL);

			try
			{
				Connection.Open();
				int intRecs = command.ExecuteNonQuery();
				strResult = $"Successfully Inserted {intRecs} Records";
				Connection.Close();
			}
			catch (Exception err)
			{
				strResult = "Error " + err.Message;
			}
			finally
			{

			}

			return strResult;
		}
	}
}
