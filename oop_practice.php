
class Customers

{

    private $firstName, $lastName, $address, $hiringDate,$seniority;

    public function __construct($fn, $ln, $ad, $hd){

        $this->firstName = $fn;

        $this->lastName = $ln;

        $this->hiringDate = $hd;
        
        $this->setSeniority();

    }

    //Create a Method

    private function getFirstName()
    {

        return $this->firstName;

    }

    //Create a Method


    //Create a Method

    private function getAddress()

    {

        return $this->address;

    }

    

//Create a Method

    private function setSeniority()

    {

        $obj = new DateTime();

        $currentDate =$obj->format("Y");

    }



//Create a Method

    private function getSeniority()

    {

            return $this->seniority;

    }



//Create a Method

    public function display_output(){

    echo "<p>First Name:".$this->getFirstName()."</p>";

    echo "<p>Last Name:".$this->getLastName()."</p>";

    echo "<p>Last Name:".$this->getAddress()."</p>";

    echo "<p>Seniority:".$this->getSeniority()."</p>";

    }

 

   //Create a Destructor Method

   //This Method is automatically called at the end of the script

  { 

       

   }

}


