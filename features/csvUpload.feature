Feature: CSV to PDF Cyclist licenses API
    In order to get Cyclist licenses
    As a bike user
    I need to be able to upload a .csv file and get a license

    Scenario: CSV call requires an attached file
        Given I am an authenticated user
        When I call the endpoint with no file attached
        Then The API responds with a 400 status

    Scenario: CSV Upload incorrect file extension
        Given I am an authenticated user
        When I upload a "file" other than .csv
        Then The API responds with a 415 status

    Scenario: CSV Upload to server wrong format
        Given I am an authenticated user
        When I upload a incorrectly formatted .csv "file"
        Then The API respondes with a 422 status

    Scenario: CSV Upload to server success
        Given I am an authenticated user
        When I upload a correctly formatted .csv "file"
        Then The API responds with a 200 status
        And The File gets stored on server

    Scenario: Nightly CSV to PDF process
        Given I am an administrator
        When the nightly script is run
        Then The API gets all not processed CSV uploads urls / ids
        And transform them from CSV to PDF
        And Sends an email to each user with the PDF attached
        And Sends an email to both partner certification center and BA

    Scenario: Get PDF License
        Given I am an authenticated user
        When I call the getPDFLicense endpoint
        Then The API returns with the PDF if found
