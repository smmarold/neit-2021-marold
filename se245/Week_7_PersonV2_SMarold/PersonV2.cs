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

		//Function for connecting to and adding a record to the database. 
		public string AddARecord()
		{
			string strResult = "";

			//create a new connection
			SqlConnection Connection = new SqlConnection();

			//Set the connection string property to the Server address with UN and PW. 
			Connection.ConnectionString = @"Server=sql.neit.edu\studentsqlserver,4500;Database=SE245_SMarold;User Id=SE245_SMarold;Password=001226919;";

			//Store the proper sql command in a string
			string strSQL = "INSERT INTO PersonV2 (FirstName, MiddleName, LastName, Phone, Email, Street1, Street2, City, State, Zip, CellPhone, InstagramURL) VALUES (@FirstName, @MiddleName, @LastName, @Phone, @Email, @Street1, @Street2, @City, @State, @Zip, @CellPhone, @InstagramURL)";

			//Create a new Command. Set the properties to the SQL command and Connection. 
			SqlCommand command = new SqlCommand();
			command.CommandText = strSQL;
			command.Connection = Connection;

			//Replace vars with the data from the PersonV2 Object. 
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


			//Attempt to connect. If successful, execute the SQL command to add the record, and close the connection. 
			//If unsuccessful, log and record the error message. 
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
