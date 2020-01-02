# Activate Learning - Support Application

Support Application that houses Form Requests. The forms available on this application are below.

1. Access Request
2. Digital Setup Request
3. Refund Request

## Technologies

Below is the list of technologies used to build the application:

1. Laravel 5.4
2. VueJS
3. Axios
4. Tailwind CSS
5. SQLite

## How the Application Works

All forms below are built on the same Laravel engine. They each have a separate link. Please see below for further details on how each form works and its purpose. 

### Access Request Form

The access request form is used for internal purposes only. The form is not available to customers unless they have direct link. The form is only completed by an Activate Learning employee. Once the form is submitted an email is generated to support@activatlearning.com. The support staff then process the request based on the data in the email request.

### Digital Setup Request

The digital setup request form is used for internal purposes only. The form is not available to customers unless they have direct link. The form is only completed by an Activate Learning employee. Once the form is submitted an email is generated to support@activatlearning.com. The support staff then process the request based on the data in the email request.

### Refund Request

The refund request form is used by internal and external (customers) users. Once the form is submitted the data from the form is saved into a google spreadsheet available https://docs.google.com/spreadsheets/d/14GTIRo0Y0NPJv7eTO_g5pzJdN_V4cJ3OHyUBX1sb00s/edit#gid=0. The information on the form can be repeated since each product being returned creates a line on the google spreadsheet. 

There is one thing to note about this spreadsheet it cannot be changed. It needs to remain the same format at all times. If changes are to be made those changes need to be made aware to development otherwise the submission will fail. 