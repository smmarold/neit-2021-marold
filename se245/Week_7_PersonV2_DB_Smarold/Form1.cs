using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Week_6_Lab
{
	public partial class Form1 : Form
	{
		public Form1()
		{
			InitializeComponent();
		}

		private void button1_Click(object sender, EventArgs e)
		{
			//Create person instance, initialize Feedback
			PersonV2 tempPerson = new PersonV2();
			tempPerson.Feedback = "";

			//Gather text from textboxes, set to person's properties
			tempPerson.FirstName = txtFirstName.Text;
			tempPerson.MiddleName = txtMiddleName.Text;
			tempPerson.LastName = txtLastName.Text;
			tempPerson.Phone = txtPhoneNum.Text;
			tempPerson.Email = txtEmail.Text;
			tempPerson.Street1 = txtStreet1.Text;
			tempPerson.Street2 = txtStreet2.Text;
			tempPerson.City = txtCity.Text;
			tempPerson.State = txtState.Text;
			tempPerson.Zip = txtZip.Text;
			tempPerson.CellPhone = txtCellPhone.Text;
			tempPerson.InstagramURL = txtInstaURL.Text;

			//check the Feedback Property. If if contains an ERROR, display the error message in red. 
			//The Validations and setting of Errors occurs in the Person class definition and Validation Library
			if (tempPerson.Feedback.Contains("ERROR: "))
			{
				lblFeedback.ForeColor = System.Drawing.Color.Red;
				lblFeedback.Text = tempPerson.Feedback;
			}
			//If there are no errors, Call AddARecord from PersonV2 and add them to the DB.  
			else
			{
				/*
				lblFeedback.Text = tempPerson.FirstName + " " + tempPerson.MiddleName + " " + tempPerson.LastName + "\n"
					+ tempPerson.Street1 + " " + tempPerson.Street2 + "\n" + tempPerson.City + ", " + tempPerson.State + " " + tempPerson.Zip
					+ "\nPhone:" + tempPerson.Phone + "\nCell" + tempPerson.CellPhone + "\n" + tempPerson.Email + "\n" + tempPerson.InstagramURL;
				*/

				lblFeedback.ForeColor = System.Drawing.Color.Black;
				lblFeedback.Text = tempPerson.AddARecord();
			}
		}
	}
}
