<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am an authenticated user
     */
    public function iAmAnAuthenticatedUser()
    {
        return true;
    }

    /**
     * @When I call the endpoint with no file attached
     */
    public function iCallTheEndpointWithNoFileAttached()
    {
        throw new PendingException();
    }
    
    /**
     * @When I upload a :arg1 other than .csv
     */
    public function iUploadAOtherThanCsv($arg1)
    {

        //TODO: validateFileType()
        throw new PendingException();
    }

    /**
     * @Then The API responds with a :arg1 status
     */
    public function theApiRespondsWithAStatus($arg1)
    {
        throw new PendingException();
    }


    /**
     * @When I upload a incorrectly formatted .csv :arg1
     */
    public function iUploadAIncorrectlyFormattedCsv($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I upload a correctly formatted .csv :arg1
     */
    public function iUploadACorrectlyFormattedCsv($arg1)
    {

        throw new PendingException();
    }

    /**
     * @Then The API respondes with a :arg1 status
     */
    public function theApiRespondesWithAStatus($arg1)
    {
        throw new PendingException();
    }
}
