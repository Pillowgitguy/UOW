#include <string>
#include <vector>
#include <iostream>
#include <fstream>
#include <string.h>
#include <math.h>
#include <iomanip>
#include <limits>

using namespace std;

// Function prototype
void readAndProcess(string** &mainMap, int& xMapRange, int& yMapRange, string** &cityMap, vector<string>& idNameCity,
                    string ** &cloudMap, string ** &cloudMapLMH, string ** &pressureMap, string ** &pressureMapLMH);
void createMap(string** &maap, int& xMapRange, int& yMapRange, int& yEnd, int&yStart, int& xEnd, int& xStart);
vector<string> splitString (string str, string delim);
void deleteMapMemory(string** &mainMap, int yMapRange);
void readCityLocation(string cityLocation, string** &cityMap, int arrayYSize, int arrayXSize, vector<string> &idNameCity);
void readPerimeter(string** &mainMap, int& xMapRange, int& yMapRange);
void readCloudPressure(string ** &cloudMap, string cloudCover, int xMapRange, int yMapRange, int arrayYSize, int arrayXSize,
                    string ** &cloudMapLMH);
void displayCloudPressureMap(string** cloudPressure, int xMapRange, int yMapRange);
void forecastSummaryReport(vector<string> idNameCity, string ** mainMap, string ** cloudMap, string ** pressureMap,
                           int xMapRange, int yMapRange);

int main()
{
    // Variable to hold user'input
    string tempChoice;
    int counter = 0;
    int userChoice;
    string enter = " ";
    int xMapRange;
    int yMapRange;
    string ** mainMap;
    string ** cityMap;
    string ** cloudMap;
    string ** cloudMapLMH;
    string ** pressureMap;
    string ** pressureMapLMH;
    vector<string> idNameCity;
    idNameCity.push_back("Blank");

    while (userChoice != 8){
        try {
            // Student's information
            cout << "Student ID     : 7432434" << endl;
            cout << "Student Name   : Chua Tian Sheng" << endl;
            cout << "------------------------------------------" << endl;

            // Main menu
            cout << "Welcome to Weather Information Processing System! \n" << endl;
            cout << "1)     Read in and process a configuration file" << endl;
            cout << "2)     Display city map" << endl;
            cout << "3)     Display cloud coverage map (cloudiness index)" << endl;
            cout << "4)     Display cloud coverage map (LMH symbols)" << endl;
            cout << "5)     Display atmospheric pressure map (pressure index)" << endl;
            cout << "6)     Display atmospheric pressure map (LMH symbols)" << endl;
            cout << "7)     Show weather forecast summary report" << endl;
            cout << "8)     Quit \n" << endl;

            // Prompting user to enter his/her choice
            cout << "Please enter your choice: ";
            cin >> tempChoice;

            userChoice = stoi(tempChoice);

            // Informing user to input int from 1 to 8
            if (userChoice >8 || userChoice <= 0){
                cout << "Please enter number from 1 to 8 only\n" << endl;
            }

            cin.ignore(numeric_limits<streamsize>::max(), '\n');

            switch(userChoice){
                case 1:
                    readAndProcess(mainMap, xMapRange, yMapRange, cityMap, idNameCity, cloudMap, cloudMapLMH, pressureMap,
                                   pressureMapLMH);
                    counter++;
                    break;
                case 2:
                    // If user have not selected option 1 first
                    if (counter == 0){
                        throw out_of_range(" ");
                    }
                    do{
                        // Displaying the city map
                        for (int i = 0; i < yMapRange; i++){
                            for (int j = 0; j < xMapRange; j++){
                                cout << cityMap[i][j] << ' ';
                            }
                            cout << endl;
                        }
                        cout << "\nPress <enter> to go back to main menu";
                        getline(cin, enter);
                        if (enter == "") {
                          break;
                        }
                    } while (1);
                    break;
                case 3:
                    // If user have not selected option 1 first
                    if (counter == 0){
                        throw out_of_range(" ");
                    }
                    do{
                        // Displaying cloud coverage map (cloudiness index)
                        displayCloudPressureMap(cloudMap, xMapRange, yMapRange);
                        cout << "\nPress <enter> to go back to main menu";
                        getline(cin, enter);
                        if (enter == "") {
                          break;
                        }
                    } while (1);
                    break;
                case 4:
                    // If user have not selected option 1 first
                    if (counter == 0){
                        throw out_of_range(" ");
                    }
                    do{
                        // Displaying cloud coverage map (LMH symbols)
                        for (int i = 0; i < yMapRange; i++){
                            for (int j = 0; j < xMapRange; j++){
                                cout << cloudMapLMH[i][j] << ' ';
                            }
                            cout << endl;
                        }
                        cout << "\nPress <enter> to go back to main menu";
                        getline(cin, enter);
                        if (enter == "") {
                          break;
                        }
                    } while (1);
                    break;
                case 5:
                    // If user have not selected option 1 first
                    if (counter == 0){
                        throw out_of_range(" ");
                    }
                    do{
                        // Displaying atmospheric pressure map (pressure index)
                        displayCloudPressureMap(pressureMap, xMapRange, yMapRange);
                        cout << "\nPress <enter> to go back to main menu";
                        getline(cin, enter);
                        if (enter == "") {
                          break;
                        }
                    } while (1);
                    break;
                case 6:
                    // If user have not selected option 1 first
                    if (counter == 0){
                        throw out_of_range(" ");
                    }
                    do{
                        // Displaying atmospheric pressure map (pressure index)
                        for (int i = 0; i < yMapRange; i++){
                            for (int j = 0; j < xMapRange; j++){
                                cout << pressureMapLMH[i][j] << ' ';
                            }
                            cout << endl;
                        }
                        cout << "\nPress <enter> to go back to main menu";
                        getline(cin, enter);
                        if (enter == "") {
                          break;
                        }
                    } while (1);
                    break;
                case 7:
                    // If user have not selected option 1 first
                    if (counter == 0){
                        throw out_of_range(" ");
                    }
                    do{
                        forecastSummaryReport(idNameCity, mainMap, cloudMap, pressureMap, xMapRange, yMapRange);
                        cout << "\nPress <enter> to go back to main menu";
                        getline(cin, enter);
                        if (enter == "") {
                          break;
                        }
                    } while (1);
                    break;
                case 8:
                    deleteMapMemory(mainMap, yMapRange);
                    deleteMapMemory(cityMap, yMapRange);
                    deleteMapMemory(cloudMap, yMapRange);
                    deleteMapMemory(cloudMapLMH, yMapRange);
                    deleteMapMemory(pressureMap, yMapRange);
                    deleteMapMemory(pressureMapLMH, yMapRange);
                    cout << "Bye" << endl;
                    break;
            }
        }

        // Case when user input string
        catch (invalid_argument convert){
            cout << "Please input numbers only!!\n" << endl;
        }
        // Case when user have not input file
        catch (out_of_range e){
            cout << "Please chose option 1 first to input the file first\n" << endl;
        }
    }
    return 0;
}

// Function to read and process configuration file
void readAndProcess(string** &mainMap, int& xMapRange, int& yMapRange, string** &cityMap, vector<string>& idNameCity,
                    string ** &cloudMap, string ** &cloudMapLMH, string ** &pressureMap, string ** &pressureMapLMH) {

    // Variables
    string userInput;
    ifstream inputFile;
    string addOn = ".txt";
    int xStart;
    int xEnd;
    int yStart;
    int yEnd;
    string cityLocation;
    string cloudCover;
    string pressure;
    int counter = 1;
    vector<string> dataItems;
    string gridRange;
    int arrayXSize;
    int arrayYSize;

	cout << "\n[Read in and process a configuration file]" << endl;

	// Prompting user to input confiq filename
	cout << "Please enter config filename: ";

	// Storing user input into the variable
	cin >> userInput;

	// Case if user didn't input .txt at the filename
    if (userInput.find(addOn) == string::npos) {
        userInput.append(".txt");
    }

    try {
        // Opening the file
        inputFile.open(userInput.c_str());

        // Case if file if not found
        if(!inputFile.is_open()){
          throw out_of_range(" ");
        }

        // Reading the file
        while (inputFile.good()){

            string aLine;
            getline (inputFile, aLine);

            switch(counter){

                // Reading first line of text file, grids for x-axis
                case 1:

                    /*Splitting the first line of text into words and the range of grid lines.
                    E.g. GridX_IdxRange = 0-8 into GridX_IdxRange and 0-8*/
                    dataItems = splitString (aLine, "=");

                    /* Assigning the grid line range to a string variable.
                    E.g. grid range = 0-8*/
                    gridRange = dataItems[1];

                    /* Splitting the lower and upper range of grid line.
                    E.g. 0-8 into 0 and 8*/
                    dataItems = splitString (gridRange, "-");

                    xStart = stoi(dataItems[0]);
                    xEnd = stoi(dataItems[1]);
                    arrayXSize = xEnd + 4;
                    break;

                // Reading second line of text file, grids for y-axis
                case 2:
                     // Splitting the first line of text into words and the range of grid lines
                    dataItems = splitString (aLine, "=");

                    // Assigning the grid line range to a string variable
                    gridRange = dataItems[1];

                    // Splitting the lower and upper range of grid line
                    dataItems = splitString (gridRange, "-");

                    yStart = stoi(dataItems[0]);
                    yEnd = stoi(dataItems[1]);
                    arrayYSize = yEnd + 4;
                    break;

                // Reading 3rd line
                case 3:
                    cityLocation = aLine;
                    break;
                // Reading 4th line
                case 4:
                    cloudCover = aLine;
                    break;
                // Reading 5th line
                case 5:
                    pressure = aLine;
                    break;
            }

            // Increasing the counter
            counter++;
        }

        // Close the file
        inputFile.close();

        xMapRange = arrayXSize-xStart;
        yMapRange = arrayYSize-yStart;

        // Create the base map
        createMap(mainMap, xMapRange, yMapRange, yEnd, yStart, xEnd, xStart);
        createMap(cityMap, xMapRange, yMapRange, yEnd, yStart, xEnd, xStart);
        createMap(cloudMap, xMapRange, yMapRange, yEnd, yStart, xEnd, xStart);
        createMap(cloudMapLMH, xMapRange, yMapRange, yEnd, yStart, xEnd, xStart);
        createMap(pressureMap, xMapRange, yMapRange, yEnd, yStart, xEnd, xStart);
        createMap(pressureMapLMH, xMapRange, yMapRange, yEnd, yStart, xEnd, xStart);

       // Read city location
       readCityLocation(cityLocation, cityMap, arrayYSize, arrayXSize, idNameCity);
       readCityLocation(cityLocation, mainMap, arrayYSize, arrayXSize, idNameCity);

       // Read city's perimeter
       readPerimeter(mainMap, xMapRange, yMapRange);

       // Read cloud cover
       readCloudPressure(cloudMap, cloudCover, xMapRange, yMapRange, arrayYSize, arrayXSize, cloudMapLMH);

       // Read pressure
       readCloudPressure(pressureMap, pressure, xMapRange, yMapRange, arrayYSize, arrayXSize, pressureMapLMH);

        cout << "\nReading in GridX_IdxRange : " << xStart << "-" << xEnd << "... done!"  << endl;
        cout << "Reading in GridY_IdyRange : " << yStart << "-" << yEnd << "... done!" << endl;
        cout << "Storing data from input file: " << endl;
        cout << cityLocation << " ... done!" << endl;
        cout << cloudCover << " ... done!" << endl;
        cout << pressure << " ... done!" << endl;
        cout << "All records successfully stored. Going back to main menu...\n" << endl;
    }
    catch (out_of_range e){
        cout << "File is not found\n" << endl;
    }

}

// Splitting of string
vector<string> splitString (string str, string delim)
{
    // Variables
    vector<string > result;
    size_t pos = 0;
    string token;

    while ((pos = str.find(delim)) != std::string::npos)
    {
        token = str.substr(0, pos);
        result.push_back(token);
        str.erase(0, pos+delim.length());
    }

    // Adding string into the result vector
    if (!str.empty())
	    result.push_back(str);

    return (result);
}

void createMap(string** &maap, int& xMapRange, int& yMapRange, int& yEnd, int&yStart, int& xEnd, int& xStart){
    // Allocate memory for the array of pointers, row (arrayYsize - yStart to get the range e.g. 0-8, 10-24)
    maap = new string *[yMapRange];

    // Allocate memory to each row of the 2d array, col
    for (int i = 0; i < yMapRange; i++){
        maap[i] = new string [xMapRange];
    }

    // Putting values into the array
    for (int i = 0; i < yMapRange; i++){
        for (int j = 0; j < xMapRange; j++){
            maap[i][j] = " ";
        }
    }

    int yStarting = yEnd;
    // Values for the y-axis range, yEnd - yStart is to get how many times to loop
   for (int i = 0; i <= yEnd-yStart; i++) {
        maap[i+1][0] = to_string(yStarting);
        yStarting--;
   }

   int xStarting = xStart;
   // Values for the x-axis range
   for (int i =0; i <= xEnd-xStart; i++){
        maap[yMapRange-1][i+2] = to_string(xStarting);
        xStarting++;
   }

   // Values for #, x btm range
    for (int i =1; i <= xMapRange-1; i++){
        maap[yMapRange-2][i] = "#";
   }

   // Values for #, x top range
    for (int i =0; i <= xMapRange-2; i++){
        maap[0][i+1] = "#";
   }

   // Values for #,y left range
    for (int i =0; i < yMapRange-2; i++){
        maap[i+1][1] = "#";
   }

   // Values for #, y right range
   for (int i =0; i < yMapRange-2; i++){
        maap[i+1][xMapRange-1] = "#";
   }

}

void readCityLocation(string cityLocation, string** &cityMap, int arrayYSize, int arrayXSize, vector<string> &idNameCity){

    vector<string> cityId;
    vector<string> twoIndexItem;
    vector<string> oneIndexItem;
    string firstIndex;
    string secondIndex;
    int secondPosition;
    int firstPosition;
    ifstream inputFile;
    int counter = 0;

    // Opening citLocation file
    inputFile.open(cityLocation.c_str());

    while (inputFile.good()){

        string aLine;
        // Getting line by line from file
        getline (inputFile, aLine);
        // Splitting the line
        cityId = splitString (aLine, "-");

        // Split to get the index [1, 1] --> [1 and 1]
        twoIndexItem = splitString(cityId[0], ",");

        // Split to get the exact index [1 --> [ and 1, getting the first index
        oneIndexItem = splitString(twoIndexItem[0], "[");

        firstIndex = oneIndexItem[1];

        // Split to get the exact index 1] --> 1 and ], getting the second index
        oneIndexItem = splitString(twoIndexItem[1], "]");

        secondIndex = oneIndexItem[0];
        // Remove the first white space
        secondIndex.erase(0,1);

        // Get the y axis position
        for (int i = 0; i < arrayXSize-1; i++){
            if (cityMap[arrayYSize-1][i] != " "){
                if(firstIndex == cityMap[arrayYSize-1][i]){
                    firstPosition = i;
                }
            }
        }


        // Get the x axis position
        for (int i = 0; i < arrayYSize-1; i++){
            if (cityMap[i][0] != " "){
                if(secondIndex == cityMap[i][0]){
                    secondPosition = i;
                }
            }
        }

        // Input data into the map
        cityMap[secondPosition][firstPosition] = cityId[1];

        // Storing the city id to it's name
        for (int i = 0; i < idNameCity.size(); i++){
            if (cityId[1] == idNameCity[i]){
                // If the counter increases, the id is present
                counter++;
            }
        }

        if (counter == 0){
            idNameCity.push_back(cityId[1]);
            idNameCity.push_back(cityId[2]);
        }

        // Reset the boolean value
        counter = 0;
    }

    // Close file
    inputFile.close();
}

void readPerimeter(string** &mainMap, int& xMapRange, int& yMapRange){

    // Vertical traversal, top to bottom
   for (int i = 0; i < yMapRange-1; i++){
        for (int j = 1; j < xMapRange; j++){

            // Left and top left side
            if ( (mainMap[i][j] != " ") && (mainMap[i][j] != "#") && mainMap[i-1][j] != "#" ){
                mainMap[i-1][j] = mainMap[i][j]; // Top
                mainMap[i][j-1] = mainMap[i][j]; // Left
                mainMap[i-1][j-1] = mainMap[i][j]; // Left top

            }
        }
    }


    // Vertical traversal, bottom to top
    for (int i = yMapRange-2; i >= 0; i--){      //row
        for (int j = xMapRange-1; j > 0; j--){    //col
            // For bottom of city
            if( (mainMap[i][j] == " ") &&  (mainMap[i-1][j] != " ") && (mainMap[i-1][j] != "#")){
                mainMap[i][j] = mainMap[i-1][j];
            }
            // For right of the city
            if( (mainMap[i][j] == " ") && (mainMap[i][j-1] != " ") && (mainMap[i][j-1] != "#") ) {
                mainMap[i][j] = mainMap[i][j-1];
            }

            if ( (mainMap[i][j] == " ") && (mainMap[i-1][j-1] != " ") && (mainMap[i-1][j-1] != "#") ){
                mainMap[i][j] = mainMap[i-1][j-1];
            }

        }
    }
}


void readCloudPressure(string ** &cloudMap, string cloudCover, int xMapRange, int yMapRange, int arrayYSize,
                       int arrayXSize, string ** &cloudMapLMH){

    ifstream inputFile;
    vector<string> forecast;
    vector<string> twoIndexItem;
    vector<string> oneIndexItem;
    string firstIndex;
    string secondIndex;
    int secondPosition;
    int firstPosition;

    // Opening cloudCover file
    inputFile.open(cloudCover.c_str());

    while(inputFile.good()){

        string aLine;
        // Getting line by line from file
        getline (inputFile, aLine);

        // Splitting the line
        forecast = splitString (aLine, "-");

        // Split to get the index [1, 1] --> [1 and 1]
        twoIndexItem = splitString(forecast[0], ",");

        // Split to get the exact index [1 --> [ and 1, getting the first index
        oneIndexItem = splitString(twoIndexItem[0], "[");

        firstIndex = oneIndexItem[1];

        // Split to get the exact index 1] --> 1 and ], getting the second index
        oneIndexItem = splitString(twoIndexItem[1], "]");

        secondIndex = oneIndexItem[0];
        // Remove the first white space
        secondIndex.erase(0,1);

        // Get the y axis position
        for (int i = 0; i < arrayXSize-1; i++){
            if (cloudMap[arrayYSize-1][i] != " "){
                if(firstIndex == cloudMap[arrayYSize-1][i]){
                    firstPosition = i;
                }
            }
        }


        // Get the x axis position
        for (int i = 0; i < arrayYSize-1; i++){
            if (cloudMap[i][0] != " "){
                if(secondIndex == cloudMap[i][0]){
                    secondPosition = i;
                }
            }
        }

        // Input data for cloudMapLMH/ pressureLMH
        if(stoi(forecast[1]) < 35){
            cloudMapLMH[secondPosition][firstPosition] = "L";
        }
        else if( stoi(forecast[1]) < 65){
            cloudMapLMH[secondPosition][firstPosition] = "M";
        }
        else {
            cloudMapLMH[secondPosition][firstPosition] = "H";
        }

        // Input data into the cloudMap/ pressureMap
        cloudMap[secondPosition][firstPosition] = forecast[1];

    }

    // Close file
    inputFile.close();
}

void displayCloudPressureMap(string** cloudPressure, int xMapRange, int yMapRange){

    vector<string> orignalNum;
    int counter = 0;

    // Change the values into cloudiness index
    for (int i = 1; i < yMapRange-2; i++){
        for (int j = 2; j < xMapRange-1; j++){
            if (cloudPressure[i][j] != "#" && cloudPressure[i][j] != " "){
                // Divide by 10 to get a single digit, e.g. 32/10 = 3
                orignalNum.push_back(cloudPressure[i][j]);
                cloudPressure[i][j] = to_string( (stoi(cloudPressure[i][j]) / 10));
            }
        }
    }

    // Displaying the cloud map
    for (int i = 0; i < yMapRange; i++){
        for (int j = 0; j < xMapRange; j++){
            cout << cloudPressure[i][j] << ' ';
        }
        cout << endl;
    }

    // Change the values back;
    for (int i = 1; i < yMapRange-2; i++){
        for (int j = 2; j < xMapRange-1; j++){
            if (cloudPressure[i][j] != "#" && cloudPressure[i][j] != " "){
                cloudPressure[i][j] = orignalNum[counter];
                counter++;
            }

        }
    }
}

void forecastSummaryReport(vector<string> idNameCity, string ** mainMap, string ** cloudMap, string ** pressureMap,
                           int xMapRange, int yMapRange){

    float averageCloudCover = 0;
    float averageAirPressure = 0;
    float probabiltyRain = 0;
    int totalGridArea = 0;
    string cloudCoverSymbol;
    string pressureSymbol;
    string rainGraphic;
    float probRain;

    //Set to display of float numbers in 2 decimal place
    cout << fixed;
    cout << setprecision(2);

    cout << "Weather Forecast Summary Report" << endl;
    cout << "---------------------------------" << endl;


    for(int i = 1; i < idNameCity.size(); i = i + 2){
        for (int k = 1; k < yMapRange-2; k++){
            for (int j = 2; j < xMapRange-1; j++){
                if (mainMap[k][j] == idNameCity[i]){
                    averageCloudCover = averageCloudCover + stof(cloudMap[k][j]);
                    averageAirPressure = averageAirPressure + stof(pressureMap[k][j]);
                    totalGridArea++;
                }
            }
        }

        averageCloudCover = averageCloudCover/totalGridArea;
        averageAirPressure = averageAirPressure/totalGridArea;

        // Symbol for cloud cover
        if(averageCloudCover < 35){
            cloudCoverSymbol = "(L)";
        }
        else if(averageCloudCover < 65){
            cloudCoverSymbol = "(M)";
        }
        else {
            cloudCoverSymbol = "(H)";
        }

        // Symbol for air pressure
        if(averageAirPressure < 35){
            pressureSymbol = "(L)";
        }
        else if(averageAirPressure < 65){
            pressureSymbol = "(M)";
        }
        else {
            pressureSymbol = "(H)";
        }

        // Get the value for graphic
        if (pressureSymbol == "(L)"){
            if (cloudCoverSymbol == "(H)"){
                rainGraphic = "~~~~\n~~~~~\n\\\\\\\\\\" ;
                probRain = 90;
            }
            else if (cloudCoverSymbol == "(M)"){
                rainGraphic = "~~~~\n~~~~~\n \\\\\\\\";
                probRain = 80;
            }
            else {
                rainGraphic = "~~~~\n~~~~~\n  \\\\\\";
                probRain = 70;
            }
        }
        else if (pressureSymbol == "(M)"){
             if (cloudCoverSymbol == "(H)"){
                rainGraphic = "~~~~\n~~~~~\n   \\\\";
                probRain = 60;
            }
            else if (cloudCoverSymbol == "(M)"){
                rainGraphic = "~~~~\n~~~~~\n    \\";
                probRain = 50;
            }
            else{
                rainGraphic = "~~~~\n~~~~~\n";
                probRain = 40;
            }
        }
        else {
           if (cloudCoverSymbol == "(H)"){
                rainGraphic = "~~~\n~~~~\n";
                probRain = 30;
            }
            else if (cloudCoverSymbol == "(M)"){
                rainGraphic = "~~\n~~~\n";
                probRain = 20;
            }
            else{
                rainGraphic = "~\n~~\n";
                probRain = 10;
            }
        }

        cout << "City Name  : " << idNameCity[i+1]<< endl;
        cout << "City ID    : " << idNameCity[i] <<endl;

        cout << "Ave. Cloud Cover (ACC)     : " << averageCloudCover << " " << cloudCoverSymbol << endl;
        cout << "Ave. Pressure (APP)        : " << averageAirPressure << " " << pressureSymbol << endl;
        cout << "Probability of Rain (%)    : " << probRain << endl;
        cout << rainGraphic << endl;
        totalGridArea = 0;
        averageCloudCover = 0;
        averageAirPressure = 0;
        cout << endl;
    }
}

void deleteMapMemory(string** &mainMap, int yMapRange){

    // Free the memory
    for (int i = 0; i < yMapRange; i++){
        delete[] mainMap[i];
    }
    delete[] mainMap;

}


