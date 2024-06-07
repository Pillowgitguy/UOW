#include <iostream>
#include <string>
#include "Point2D.h"
#include "Point3D.h"
#include "Line2D.h"
#include "Line3D.h"
#include <limits>
#include <fstream>
#include <vector>
#include <algorithm>
#include <iomanip>

using namespace std;


// Function prototype
void readAndProcess();
vector<string> splitString (string str, string delim);
void specifyFiltering();
void specifySorting();
void specifyOrder();
void viewData();
void storeData();


string tempChoice;
int userChoice;
vector<Point2D*> point2DVector;
vector<Line2D*> line2DVector;
vector<Point3D*> point3DVector;
vector<Line3D*> line3DVector;
string filterCriteria = "Point2D";
string sortingCriteria = "x-ordinate";
string sortingOrder = "ASC";
int counter = 0;
vector<string> lineStrings;


int main()
{


    while (userChoice != 7){
        try {
            // Student's information
            cout << "Student ID     : 7432434" << endl;
            cout << "Student Name   : Chua Tian Sheng" << endl;
            cout << "------------------------------------------" << endl;

            // Main menu
            cout << "Welcome to Assn3 program! \n" << endl;
            cout << "1)     Read in Data" << endl;
            cout << "2)     Specify filtering criteria (current: " << filterCriteria <<")" << endl;
            cout << "3)     Specify sorting criteria (current: " << sortingCriteria <<")"  << endl;
            cout << "4)     Specify sorting order (current: " << sortingOrder <<")" << endl;
            cout << "5)     View data" << endl;
            cout << "6)     Store data" << endl;
            cout << "7)     Quit" << endl;

            // Prompting user to enter his/her choice
            cout << "\nPlease enter your choice: ";
            cin >> tempChoice;

            userChoice = stoi(tempChoice);

            // Informing user to input int from 1 to 8
            if (userChoice >8 || userChoice <= 0){
                cout << "Please enter number from 1 to 7 only\n" << endl;
            }

            cin.ignore(numeric_limits<streamsize>::max(), '\n');

            switch(userChoice){
                case 1:
                    readAndProcess();
                    break;
                case 2:
                    specifyFiltering();
                    break;
                case 3:
                    specifySorting();
                    break;
                case 4:
                    specifyOrder();
                    break;
                case 5:
                    viewData();
                    cout << "Press any key to go back to main menu ...";
                    cin.get();
                    break;
                case 6:
                    storeData();
                    break;
                case 7:
                    // Free the memory
                    for (int i = 0; i < point2DVector.size(); i++ ){
                        delete point2DVector[i];
                    }
                    for (int i = 0; i < line2DVector.size(); i++ ){
                        delete line2DVector[i];
                    }
                    for (int i = 0; i < point3DVector.size(); i++ ){
                        delete point3DVector[i];
                    }
                    for (int i = 0; i < line3DVector.size(); i++ ){
                        delete line3DVector[i];
                    }
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

void readAndProcess(){

    string fileName;
    ifstream inputFile;
    string addOn = ".txt";
    int lineCounter = 0;
    vector<string> linesVector;
    vector<string> lineDetails;
    linesVector.push_back("1");
    int x, y, z;

    // Prompting user to input filename
    cout << "Please enter filename: ";
    // Storing user input
    cin >> fileName;

    // Case if user didn't input .txt at the filename
    if (fileName.find(addOn) == string::npos) {
        fileName.append(".txt");
    }

    try{
        // Opening the file
        inputFile.open(fileName.c_str());

        // Case if file if not found
        if(!inputFile.is_open()){
          throw out_of_range(" ");
        }
        // Reading the file
        while (inputFile.good()){

            string aLine;
            getline (inputFile, aLine);
            // Ignore comments
            if (!( aLine[0] == '/' && aLine[1] == '/') && !(aLine.length() == 0) ){
                lineCounter = 0;

                // Checking if the incoming line has already been read (Checking for duplicate)
                for(int i = 0; i < linesVector.size(); i++){
                    if (aLine == linesVector[i]){
                        lineCounter++;
                    }
                }

                // If not found, insert into the vector
                if (lineCounter == 0){
                    linesVector.push_back(aLine);
                    lineDetails = splitString(aLine, ", ");

                    // For Point2D
                    if (lineDetails.size() == 3){
                        aLine = lineDetails[1].erase(0,1);
                        x = stoi(aLine);
                        aLine = lineDetails[2].substr(0, lineDetails[2].size()-1);
                        y = stoi(aLine);

                        // Creating object and insert into vector
                        point2DVector.push_back(new Point2D(x, y));
                    }
                    // For Point3D
                    else if (lineDetails.size() == 4){
                        aLine = lineDetails[1].erase(0,1);
                        x = stoi(aLine);
                        aLine = lineDetails[2];
                        y = stoi(aLine);
                        aLine = lineDetails[3].substr(0, lineDetails[3].size()-1);
                        z = stoi(aLine);

                        // Creating object and insert into vector
                        point3DVector.push_back(new Point3D(x, y, z));
                    }
                    // For Line2D
                    else if (lineDetails.size() == 5){
                        aLine = lineDetails[1].erase(0,1);
                        x = stoi(aLine);
                        aLine = lineDetails[2].substr(0, lineDetails[2].size()-1);
                        y = stoi(aLine);

                        // Create first Point2D object
                        Point2D pt1(x, y);

                        aLine = lineDetails[3].erase(0,1);
                        x = stoi(aLine);
                        aLine = lineDetails[4].substr(0, lineDetails[4].size()-1);
                        y = stoi(aLine);

                        // Create second Point2D object
                        Point2D pt2(x,y);

                        // Create object and insert into vector
                        line2DVector.push_back(new Line2D(pt1, pt2));
                    }
                    // For Line3d
                    else if (lineDetails.size() == 7){
                        aLine = lineDetails[1].erase(0,1);
                        x = stoi(aLine);
                        aLine = lineDetails[2];
                        y = stoi(aLine);
                        aLine = lineDetails[3].substr(0, lineDetails[3].size()-1);
                        z = stoi(aLine);

                        // Create first Point3D object
                        Point3D pt1 (x, y, z);

                        aLine = lineDetails[4].erase(0,1);
                        x = stoi(aLine);
                        aLine = lineDetails[5];
                        y = stoi(aLine);
                        aLine = lineDetails[6].substr(0, lineDetails[6].size()-1);
                        z = stoi(aLine);

                        // Create second Point3D object
                        Point3D pt2 (x, y, z);
                        line3DVector.push_back(new Line3D(pt1, pt2));
                    }
                    counter++;
                }
            }
        }
    }

    catch (out_of_range e){
        cout << "File is not found\n" << endl;
    }


    // Close the file
    inputFile.close();

    cout << endl;
    cout << counter << " records read in successfully!" << endl;
    cout << "\nGoing back to main menu ...\n" << endl;
}


// Splitting of string
vector<string> splitString (string str, string delim){
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


void specifyFiltering(){

    string userInput;
    while(true){
        cout << "[Specifying filtering criteria (current: " <<  filterCriteria << ")]" << endl;

        cout << "   a)      Point2D records"  << endl;
        cout << "   b)      Point3D records"  << endl;
        cout << "   c)      Line2D records"  << endl;
        cout << "   d)      Line3D records\n"  << endl;
        cout << "   Please enter your criteria (a-d): ";
        cin >> userInput;

        if (userInput == "a" || userInput == "b" ||userInput == "c" ||userInput == "d"){

            if (userInput == "a"){
                filterCriteria = "Point2D";
                break;
            }
            else if (userInput == "b"){
                filterCriteria = "Point3D";
                break;
            }
            else if (userInput == "c"){
                filterCriteria = "Line2D";
                sortingCriteria = "Pt. 1";
                break;
            }
            else {
                filterCriteria = "Line3D";
                sortingCriteria = "Pt. 1";
                break;
            }

        }
        // If user enter anything then a-d, it will prompt the user to enter again
        else {
            cout << "\n   Please input either a, b, c or d only!\n" << endl;
        }
    }
    cout << "   Filter criteria successfully set to '" << filterCriteria << "'!\n" << endl;

}


void specifySorting(){

        string userInput;

        while (true){
            if (filterCriteria == "Line2D" || filterCriteria == "Line3D"){
                cout << "[Specifying sorting criteria (current: " <<  sortingCriteria << ")]" << endl;
                cout << "   a)      Pt. 1's (x, y) values"  << endl;
                cout << "   b)      Pt. 2's (x, y) values"  << endl;
                cout << "   c)      Length\n"  << endl;

                cout << "   Please enter your criteria (a-c): ";
                cin >> userInput;
                if (userInput == "a" || userInput == "b" ||userInput == "c"){
                    if (userInput == "a"){
                        sortingCriteria = "Pt. 1";
                        break;
                    }
                    else if (userInput == "b"){
                        sortingCriteria = "Pt. 2";
                        break;
                    }
                    else{
                        sortingCriteria = "Length";
                        break;
                    }
                }
                else {
                    cout << "\n     Please input a, b or c only!\n" << endl;
                }
            }
            else if (filterCriteria == "Point2D"){
                cout << "[Specifying sorting criteria (current: " <<  sortingCriteria << ")]" << endl;
                cout << "   a)      X ordinate value"  << endl;
                cout << "   b)      Y ordinate value"  << endl;
                cout << "   c)      Dis.t Fr Origin Value\n"  << endl;

                cout << "   Please enter your criteria (a-c): ";
                cin >> userInput;
                if (userInput == "a"){
                    sortingCriteria = "x-ordinate";
                    break;
                }
                else if (userInput == "b"){
                    sortingCriteria = "y-ordinate";
                    break;
                }
                else if (userInput == "c"){
                    sortingCriteria = "Dis.t Fr Origin";
                    break;
                }
                else {
                    cout << "\n     Please input a, b or c only!\n" << endl;
                }
            }
            else {
                cout << "[Specifying sorting criteria (current: " <<  sortingCriteria << ")]" << endl;
                cout << "   a)      X ordinate value"  << endl;
                cout << "   b)      Y ordinate value"  << endl;
                cout << "   c)      Z ordinate value"  << endl;
                cout << "   d)      Dis.t Fr Origin Value\n"  << endl;

                cout << "   Please enter your criteria (a-d): ";
                cin >> userInput;
                if (userInput == "a"){
                    sortingCriteria = "x-ordinate";
                    break;
                }
                else if (userInput == "b"){
                    sortingCriteria = "y-ordinate";
                    break;
                }
                else if (userInput == "c"){
                    sortingCriteria = "z-ordinate";
                    break;
                }
                else if (userInput == "d"){
                    sortingCriteria = "Dis.t Fr Origin";
                    break;
                }
                else {
                    cout << "\n     Please input a, b, c or d only!\n" << endl;
                }
            }
        }
    cout << "   Sorting criteria successfully set to '" << sortingCriteria << "'!\n" << endl;

};


void specifyOrder(){

    string userInput;

    while (true){
        cout << "\n[Specifying sorting order (current: " <<  sortingOrder << ")]" << endl;

        cout << "   a)      ASC (Ascending Order)"  << endl;
        cout << "   b)      DSC (Descending Order)\n"  << endl;
        cout << "       Please enter your criteria: ";
        cin >> userInput;

        if (userInput == "a" || userInput == "b"){

            if (userInput == "a"){
                sortingOrder = "ASC";
                break;
            }
            else {
                sortingOrder = "DSC";
                break;
            }

        }
        // If user enter anything then a-d, it will prompt the user to enter again
        else {
            cout << "       Please input either a, or b only!" << endl;
        }
    }
    cout << "       Sorting order successfully set to '" << sortingOrder << "'!\n" << endl;

}


void viewData(){

    cout << "\n[View data ... ]" << endl;
    cout << " filtering criteria: " << filterCriteria << endl;
    cout << " sorting criteria: " << sortingCriteria << endl;
    cout << " sorting order: " << sortingOrder << endl;
    cout << endl;

    // Point2D
    if (filterCriteria == "Point2D"){
        if (sortingCriteria == "x-ordinate"){
                if (sortingOrder == "ASC"){
                    // Sorting
                   sort(point2DVector.begin(), point2DVector.end(), [](Point2D* lhs, Point2D* rhs) {
                      return lhs->getX() < rhs->getX();
                   });
                    // Display
                    cout << setw(6) << "X" << setw(6) << "Y" << setw(5) << " " << "Dist. Fr Origin" << endl;
                    cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                    for (int i = 0; i < point2DVector.size(); i++){
                        cout << point2DVector[i]->toString();
                    }
                }
                // DSC order
                else{
                    // Sorting
                   sort(point2DVector.begin(), point2DVector.end(), [](Point2D* lhs, Point2D* rhs) {
                      return lhs->getX() > rhs->getX();
                   });
                   // Display
                    cout << setw(6) << "X" << setw(6) << "Y" << setw(5) << " " << "Dist. Fr Origin" << endl;
                    cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                    for (int i = 0; i < point2DVector.size(); i++){
                        cout << point2DVector[i]->toString();
                    }
                }
        }
        else if (sortingCriteria == "y-ordinate"){
                if (sortingOrder == "ASC"){
                    // Sorting
                   sort(point2DVector.begin(), point2DVector.end(), [](Point2D* lhs, Point2D* rhs) {
                      return lhs->getY() < rhs->getY();
                   });
                   // Display
                    cout << setw(6) << "X" << setw(6) << "Y" << setw(5) << " " << "Dist. Fr Origin" << endl;
                    cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                    for (int i = 0; i < point2DVector.size(); i++){
                        cout << point2DVector[i]->toString();
                    }
                }
                // DSC order
                else{
                    // Sorting
                   sort(point2DVector.begin(), point2DVector.end(), [](Point2D* lhs, Point2D* rhs) {
                      return lhs->getY() > rhs->getY();
                   });
                   // Display
                    cout << setw(6) << "X" << setw(6) << "Y" << setw(5) << " " << "Dist. Fr Origin" << endl;
                    cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                    for (int i = 0; i < point2DVector.size(); i++){
                        cout << point2DVector[i]->toString();
                    }
                }
        }
        // disFrOrigin
        else {
                if (sortingOrder == "ASC"){
                    // Sorting
                   sort(point2DVector.begin(), point2DVector.end(), [](Point2D* lhs, Point2D* rhs) {
                      return lhs->getScalarValue() < rhs->getScalarValue();
                   });
                   // Display
                    cout << setw(6) << "X" << setw(6) << "Y" << setw(5) << " " << "Dist. Fr Origin" << endl;
                    cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                    for (int i = 0; i < point2DVector.size(); i++){
                        cout << point2DVector[i]->toString();
                    }
                }
                // DSC order
                else{
                    // Sorting
                   sort(point2DVector.begin(), point2DVector.end(), [](Point2D* lhs, Point2D* rhs) {
                      return lhs->getScalarValue() > rhs->getScalarValue();
                   });
                   // Display
                    cout << setw(6) << "X" << setw(6) << "Y" << setw(5) << " " << "Dist. Fr Origin" << endl;
                    cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                    for (int i = 0; i < point2DVector.size(); i++){
                        cout << point2DVector[i]->toString();
                    }
                }
        }
    }
    // Point3D
    else if (filterCriteria == "Point3D"){
        if (sortingCriteria == "x-ordinate"){
                if (sortingOrder == "ASC"){
                    // Sorting
                   sort(point3DVector.begin(), point3DVector.end(), [](Point3D* lhs, Point3D* rhs) {
                      return lhs->getX() < rhs->getX();
                   });
                   // Display
                    cout << setw(6) << "X" << setw(6) << "Y" << setw(6) << "Z" << setw(5) << " " << "Dist. Fr Origin" << endl;
                    cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                    for (int i = 0; i < point3DVector.size(); i++){
                        cout << point3DVector[i]->toString();
                    }
                }
                // DSC order
                else{
                    // Sorting
                   sort(point3DVector.begin(), point3DVector.end(), [](Point3D* lhs, Point3D* rhs) {
                      return lhs->getX() > rhs->getX();
                   });
                   // Display
                    cout << setw(6) << "X" << setw(6) << "Y" << setw(6) << "Z" << setw(5) << " " << "Dist. Fr Origin" << endl;
                    cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                    for (int i = 0; i < point3DVector.size(); i++){
                        cout << point3DVector[i]->toString();
                    }
                }
        }
        else if (sortingCriteria == "y-ordinate"){
                if (sortingOrder == "ASC"){
                    // Sorting
                   sort(point3DVector.begin(), point3DVector.end(), [](Point3D* lhs, Point3D* rhs) {
                      return lhs->getY() < rhs->getY();
                   });
                   // Display
                    cout << setw(6) << "X" << setw(6) << "Y" << setw(6) << "Z" << setw(5) << " " << "Dist. Fr Origin" << endl;
                    cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                    for (int i = 0; i < point3DVector.size(); i++){
                        cout << point3DVector[i]->toString();
                    }
                }
                // DSC order
                else{
                    // Sorting
                   sort(point3DVector.begin(), point3DVector.end(), [](Point3D* lhs, Point3D* rhs) {
                      return lhs->getY() > rhs->getY();
                   });
                   // Display
                    cout << setw(6) << "X" << setw(6) << "Y" << setw(6) << "Z" << setw(5) << " " << "Dist. Fr Origin" << endl;
                    cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                    for (int i = 0; i < point3DVector.size(); i++){
                        cout << point3DVector[i]->toString();
                    }
                }
        }
        else if (sortingCriteria == "z-ordinate"){
                // Sorting
                if (sortingOrder == "ASC"){
                    // Sorting
                   sort(point3DVector.begin(), point3DVector.end(), [](Point3D* lhs, Point3D* rhs) {
                      return lhs->getZ() < rhs->getZ();
                   });
                   // Display
                    cout << setw(6) << "X" << setw(6) << "Y" << setw(6) << "Z" << setw(5) << " " << "Dist. Fr Origin" << endl;
                    cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                    for (int i = 0; i < point3DVector.size(); i++){
                        cout << point3DVector[i]->toString();
                    }
                }
                // DSC order
                else{
                    // Sorting
                   sort(point3DVector.begin(), point3DVector.end(), [](Point3D* lhs, Point3D* rhs) {
                      return lhs->getZ() > rhs->getZ();
                   });
                   // Display
                    cout << setw(6) << "X" << setw(6) << "Y" << setw(6) << "Z" << setw(5) << " " << "Dist. Fr Origin" << endl;
                    cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                    for (int i = 0; i < point3DVector.size(); i++){
                        cout << point3DVector[i]->toString();
                    }
                }
        }
        // disFrOrigin
        else {
                if (sortingOrder == "ASC"){
                    // Sorting
                   sort(point3DVector.begin(), point3DVector.end(), [](Point3D* lhs, Point3D* rhs) {
                      return lhs->getScalarValue() < rhs->getScalarValue();
                   });
                   // Display
                    cout << setw(6) << "X" << setw(6) << "Y" << setw(6) << "Z" << setw(5) << " " << "Dist. Fr Origin" << endl;
                    cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                    for (int i = 0; i < point3DVector.size(); i++){
                        cout << point3DVector[i]->toString();
                    }
                }
                // DSC order
                else{
                    // Sorting
                   sort(point3DVector.begin(), point3DVector.end(), [](Point3D* lhs, Point3D* rhs) {
                      return lhs->getScalarValue() > rhs->getScalarValue();
                   });
                   // Display
                    cout << setw(6) << "X" << setw(6) << "Y" << setw(6) << "Z" << setw(5) << " " << "Dist. Fr Origin" << endl;
                    cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                    for (int i = 0; i < point3DVector.size(); i++){
                        cout << point3DVector[i]->toString();
                    }
                }
        }
    }
    // Line2D
    else if (filterCriteria == "Line2D"){
        if (sortingCriteria == "Pt. 1"){
            if (sortingOrder == "ASC"){
                lineStrings.clear();
                vector<int> xValues;
                vector<int> yValues;

                // Sort the x in the vector first
                sort(line2DVector.begin(), line2DVector.end(), [](Line2D* lhs, Line2D* rhs) {
                    return lhs->getPt1().getX() < rhs->getPt1().getX();
                });

                // Taking all the x in the vector and put into another vector
                for (int i = 0; i < line2DVector.size(); i++){
                    xValues.push_back(line2DVector[i]->getPt1().getX());
                }

                // Sort and remove duplicates
                sort( xValues.begin(), xValues.end() );
                xValues.erase( unique( xValues.begin(), xValues.end() ), xValues.end() );

                // Getting the y and put them into another vector
                for (int i = 0; i < xValues.size(); i++){
                    for (int j = 0; j < line2DVector.size(); j++){
                        if(xValues[i] == line2DVector[j]->getPt1().getX()){
                            yValues.push_back(line2DVector[j]->getPt1().getY());
                        }
                    }
                }

                // Sort the yValues
                sort(yValues.begin(), yValues.end());

                for (int k = 0; k < xValues.size(); k++){
                    for (int i = 0; i < yValues.size(); i++){
                        for (int j = 0; j < line2DVector.size(); j++){
                            if ((xValues[k] == line2DVector[j]->getPt1().getX()) && (yValues[i] == line2DVector[j]->getPt1().getY())){
                                lineStrings.push_back(line2DVector[j]->toString());
                            }
                        }
                    }
                }
               // Display
                cout << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(5) << " " << "P2-X" << setw(6) << "P2-Y" << setw(5) << " " << "Length" << endl;
                cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                for (int i = 0; i < lineStrings.size(); i++){
                    cout << lineStrings[i];
                }

            }
            // DSC order
            else{
                lineStrings.clear();
                vector<int> xValues;
                vector<int> yValues;

                // Sort the x in the vector first
                sort(line2DVector.begin(), line2DVector.end(), [](Line2D* lhs, Line2D* rhs) {
                    return lhs->getPt1().getX() < rhs->getPt1().getX();
                });

                // Taking all the x in the vector and put into another vector
                for (int i = 0; i < line2DVector.size(); i++){
                    xValues.push_back(line2DVector[i]->getPt1().getX());
                }

                // Sort and remove duplicates
                sort( xValues.begin(), xValues.end(), greater<int>());
                xValues.erase( unique( xValues.begin(), xValues.end() ), xValues.end() );

                // Getting the y and put them into another vector
                for (int i = 0; i < xValues.size(); i++){
                    for (int j = 0; j < line2DVector.size(); j++){
                        if(xValues[i] == line2DVector[j]->getPt1().getX()){
                            yValues.push_back(line2DVector[j]->getPt1().getY());
                        }
                    }
                }

                // Sort the yValues
                sort(yValues.begin(), yValues.end(), greater<int>());

                for (int k = 0; k < xValues.size(); k++){
                    for (int i = 0; i < yValues.size(); i++){
                        for (int j = 0; j < line2DVector.size(); j++){
                            if ((xValues[k] == line2DVector[j]->getPt1().getX()) && (yValues[i] == line2DVector[j]->getPt1().getY())){
                                lineStrings.push_back(line2DVector[j]->toString());
                            }
                        }
                    }
                }
               // Display
                cout << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(5) << " " << "P2-X" << setw(6) << "P2-Y" << setw(5) << " " << "Length" << endl;
                cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                for (int i = 0; i < lineStrings.size(); i++){
                    cout << lineStrings[i];
                }
            }
        }
        else if (sortingCriteria == "Pt. 2"){
            if (sortingOrder == "ASC"){
                lineStrings.clear();
                vector<int> xValues;
                vector<int> yValues;

                // Sort the x in the vector first
                sort(line2DVector.begin(), line2DVector.end(), [](Line2D* lhs, Line2D* rhs) {
                    return lhs->getPt2().getX() < rhs->getPt2().getX();
                });

                // Taking all the x in the vector and put into another vector
                for (int i = 0; i < line2DVector.size(); i++){
                    xValues.push_back(line2DVector[i]->getPt2().getX());
                }

                // Sort and remove duplicates
                sort( xValues.begin(), xValues.end() );
                xValues.erase( unique( xValues.begin(), xValues.end() ), xValues.end() );

                // Getting the y and put them into another vector
                for (int i = 0; i < xValues.size(); i++){
                    for (int j = 0; j < line2DVector.size(); j++){
                        if(xValues[i] == line2DVector[j]->getPt2().getX()){
                            yValues.push_back(line2DVector[j]->getPt2().getY());
                        }
                    }
                }

                // Sort the yValues
                sort(yValues.begin(), yValues.end());

                for (int k = 0; k < xValues.size(); k++){
                    for (int i = 0; i < yValues.size(); i++){
                        for (int j = 0; j < line2DVector.size(); j++){
                            if ((xValues[k] == line2DVector[j]->getPt2().getX()) && (yValues[i] == line2DVector[j]->getPt2().getY())){
                                lineStrings.push_back(line2DVector[j]->toString());
                            }
                        }
                    }
                }
               // Display
                cout << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(5) << " " << "P2-X" << setw(6) << "P2-Y" << setw(5) << " " << "Length" << endl;
                cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                for (int i = 0; i < lineStrings.size(); i++){
                    cout << lineStrings[i];
                }
            }
            // DSC order
            else{
                lineStrings.clear();
                vector<int> xValues;
                vector<int> yValues;

                // Sort the x in the vector first
                sort(line2DVector.begin(), line2DVector.end(), [](Line2D* lhs, Line2D* rhs) {
                    return lhs->getPt2().getX() < rhs->getPt2().getX();
                });

                // Taking all the x in the vector and put into another vector
                for (int i = 0; i < line2DVector.size(); i++){
                    xValues.push_back(line2DVector[i]->getPt2().getX());
                }

                // Sort and remove duplicates
                sort( xValues.begin(), xValues.end(), greater<int>());
                xValues.erase( unique( xValues.begin(), xValues.end() ), xValues.end() );

                // Getting the y and put them into another vector
                for (int i = 0; i < xValues.size(); i++){
                    for (int j = 0; j < line2DVector.size(); j++){
                        if(xValues[i] == line2DVector[j]->getPt2().getX()){
                            yValues.push_back(line2DVector[j]->getPt2().getY());
                        }
                    }
                }

                // Sort the yValues
                sort(yValues.begin(), yValues.end(), greater<int>());

                for (int k = 0; k < xValues.size(); k++){
                    for (int i = 0; i < yValues.size(); i++){
                        for (int j = 0; j < line2DVector.size(); j++){
                            if ((xValues[k] == line2DVector[j]->getPt2().getX()) && (yValues[i] == line2DVector[j]->getPt2().getY())){
                                lineStrings.push_back(line2DVector[j]->toString());
                            }
                        }
                    }
                }
               // Display
                cout << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(5) << " " << "P2-X" << setw(6) << "P2-Y" << setw(5) << " " << "Length" << endl;
                cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                for (int i = 0; i < lineStrings.size(); i++){
                    cout << lineStrings[i];
                }
            }
        }
        // Length
        else {
            if (sortingOrder == "ASC"){
                // Sorting
               sort(line2DVector.begin(), line2DVector.end(), [](Line2D* lhs, Line2D* rhs) {
                  return lhs->getScalarValue() < rhs->getScalarValue();
               });
               // Display
                cout << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(5) << " " << "P2-X" << setw(6) << "P2-Y" << setw(5) << " " << "Length" << endl;
                cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                for (int i = 0; i < line2DVector.size(); i++){
                    cout << line2DVector[i]->toString();
                }
            }
            // DSC order
            else{
                // Sorting
               sort(line2DVector.begin(), line2DVector.end(), [](Line2D* lhs, Line2D* rhs) {
                  return lhs->getScalarValue() > rhs->getScalarValue();
               });
               // Display
                cout << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(5) << " " << "P2-X" << setw(6) << "P2-Y" << setw(5) << " " << "Length" << endl;
                cout << " - - - - - - - - - - - - - - - - - - -" << endl;
                for (int i = 0; i < line2DVector.size(); i++){
                    cout << line2DVector[i]->toString();
                }
            }
        }
    }
    // Line3D
    else {
        if (sortingCriteria == "Pt. 1"){
            if (sortingOrder == "ASC"){
                lineStrings.clear();
                vector<int> xValues;
                vector<int> yValues;

                // Sort the x in the vector first
                sort(line3DVector.begin(), line3DVector.end(), [](Line3D* lhs, Line3D* rhs) {
                    return lhs->getPt1().getX() < rhs->getPt1().getX();
                });

                // Taking all the x in the vector and put into another vector
                for (int i = 0; i < line3DVector.size(); i++){
                    xValues.push_back(line3DVector[i]->getPt1().getX());
                }

                // Sort and remove duplicates
                sort( xValues.begin(), xValues.end() );
                xValues.erase( unique( xValues.begin(), xValues.end() ), xValues.end() );

                // Getting the y and put them into another vector
                for (int i = 0; i < xValues.size(); i++){
                    for (int j = 0; j < line3DVector.size(); j++){
                        if(xValues[i] == line3DVector[j]->getPt1().getX()){
                            yValues.push_back(line3DVector[j]->getPt1().getY());
                        }
                    }
                }

                // Sort the yValues
                sort(yValues.begin(), yValues.end());

                for (int k = 0; k < xValues.size(); k++){
                    for (int i = 0; i < yValues.size(); i++){
                        for (int j = 0; j < line3DVector.size(); j++){
                            if ((xValues[k] == line3DVector[j]->getPt1().getX()) && (yValues[i] == line3DVector[j]->getPt1().getY())){
                                lineStrings.push_back(line3DVector[j]->toString());
                            }
                        }
                    }
                }
               // Display
                cout << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(6) << "P1-Z" << setw(6) << " "
                        << "P2-X" << setw(6) << "P2-Y" << setw(6) << "P1-Z" << setw(5) << " " << "Length" << endl;
                cout << " - - - - - - - - - - - - - - - - - - - - - - - - - - - -" << endl;
                for (int i = 0; i < lineStrings.size(); i++){
                    cout << lineStrings[i];
                }
            }
            // DSC order
            else{
                lineStrings.clear();
                vector<int> xValues;
                vector<int> yValues;

                // Sort the x in the vector first
                sort(line3DVector.begin(), line3DVector.end(), [](Line3D* lhs, Line3D* rhs) {
                    return lhs->getPt1().getX() < rhs->getPt1().getX();
                });

                // Taking all the x in the vector and put into another vector
                for (int i = 0; i < line3DVector.size(); i++){
                    xValues.push_back(line3DVector[i]->getPt1().getX());
                }

                // Sort and remove duplicates
                sort( xValues.begin(), xValues.end(), greater<int>());
                xValues.erase( unique( xValues.begin(), xValues.end() ), xValues.end() );

                // Getting the y and put them into another vector
                for (int i = 0; i < xValues.size(); i++){
                    for (int j = 0; j < line3DVector.size(); j++){
                        if(xValues[i] == line3DVector[j]->getPt1().getX()){
                            yValues.push_back(line3DVector[j]->getPt1().getY());
                        }
                    }
                }

                // Sort the yValues
                sort(yValues.begin(), yValues.end(), greater<int>());

                for (int k = 0; k < xValues.size(); k++){
                    for (int i = 0; i < yValues.size(); i++){
                        for (int j = 0; j < line3DVector.size(); j++){
                            if ((xValues[k] == line3DVector[j]->getPt1().getX()) && (yValues[i] == line3DVector[j]->getPt1().getY())){
                                lineStrings.push_back(line3DVector[j]->toString());
                            }
                        }
                    }
                }
               // Display
                cout << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(6) << "P1-Z" << setw(6) << " "
                        << "P2-X" << setw(6) << "P2-Y" << setw(6) << "P1-Z" << setw(5) << " " << "Length" << endl;
                cout << " - - - - - - - - - - - - - - - - - - - - - - - - - - - -" << endl;
                for (int i = 0; i < lineStrings.size(); i++){
                    cout << lineStrings[i];
                }
            }
        }
        else if (sortingCriteria == "Pt. 2"){
            if (sortingOrder == "ASC"){
                lineStrings.clear();
                vector<int> xValues;
                vector<int> yValues;

                // Sort the x in the vector first
                sort(line3DVector.begin(), line3DVector.end(), [](Line3D* lhs, Line3D* rhs) {
                    return lhs->getPt2().getX() < rhs->getPt2().getX();
                });

                // Taking all the x in the vector and put into another vector
                for (int i = 0; i < line3DVector.size(); i++){
                    xValues.push_back(line3DVector[i]->getPt2().getX());
                }

                // Sort and remove duplicates
                sort( xValues.begin(), xValues.end() );
                xValues.erase( unique( xValues.begin(), xValues.end() ), xValues.end() );

                // Getting the y and put them into another vector
                for (int i = 0; i < xValues.size(); i++){
                    for (int j = 0; j < line3DVector.size(); j++){
                        if(xValues[i] == line3DVector[j]->getPt2().getX()){
                            yValues.push_back(line3DVector[j]->getPt2().getY());
                        }
                    }
                }

                // Sort the yValues
                sort(yValues.begin(), yValues.end());

                for (int k = 0; k < xValues.size(); k++){
                    for (int i = 0; i < yValues.size(); i++){
                        for (int j = 0; j < line3DVector.size(); j++){
                            if ((xValues[k] == line3DVector[j]->getPt2().getX()) && (yValues[i] == line3DVector[j]->getPt2().getY())){
                                lineStrings.push_back(line3DVector[j]->toString());
                            }
                        }
                    }
                }
               // Display
                cout << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(6) << "P1-Z" << setw(6) << " "
                        << "P2-X" << setw(6) << "P2-Y" << setw(6) << "P1-Z" << setw(5) << " " << "Length" << endl;
                cout << " - - - - - - - - - - - - - - - - - - - - - - - - - - - -" << endl;
                for (int i = 0; i < lineStrings.size(); i++){
                    cout << lineStrings[i];
                }
            }
            // DSC order
            else{
                lineStrings.clear();
                vector<int> xValues;
                vector<int> yValues;

                // Sort the x in the vector first
                sort(line3DVector.begin(), line3DVector.end(), [](Line3D* lhs, Line3D* rhs) {
                    return lhs->getPt2().getX() < rhs->getPt2().getX();
                });

                // Taking all the x in the vector and put into another vector
                for (int i = 0; i < line3DVector.size(); i++){
                    xValues.push_back(line3DVector[i]->getPt2().getX());
                }

                // Sort and remove duplicates
                sort( xValues.begin(), xValues.end(), greater<int>());
                xValues.erase( unique( xValues.begin(), xValues.end() ), xValues.end() );

                // Getting the y and put them into another vector
                for (int i = 0; i < xValues.size(); i++){
                    for (int j = 0; j < line3DVector.size(); j++){
                        if(xValues[i] == line3DVector[j]->getPt2().getX()){
                            yValues.push_back(line3DVector[j]->getPt2().getY());
                        }
                    }
                }

                // Sort the yValues
                sort(yValues.begin(), yValues.end(), greater<int>());

                for (int k = 0; k < xValues.size(); k++){
                    for (int i = 0; i < yValues.size(); i++){
                        for (int j = 0; j < line3DVector.size(); j++){
                            if ((xValues[k] == line3DVector[j]->getPt2().getX()) && (yValues[i] == line3DVector[j]->getPt2().getY())){
                                lineStrings.push_back(line3DVector[j]->toString());
                            }
                        }
                    }
                }
               // Display
                cout << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(6) << "P1-Z" << setw(6) << " "
                        << "P2-X" << setw(6) << "P2-Y" << setw(6) << "P1-Z" << setw(5) << " " << "Length" << endl;
                cout << " - - - - - - - - - - - - - - - - - - - - - - - - - - - -" << endl;
                for (int i = 0; i < lineStrings.size(); i++){
                    cout << lineStrings[i];
                }
            }
        }
        // Length
        else {
            if (sortingOrder == "ASC"){
                // Sorting
               sort(line3DVector.begin(), line3DVector.end(), [](Line3D* lhs, Line3D* rhs) {
                  return lhs->getScalarValue() < rhs->getScalarValue();
               });
               // Display
                cout << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(6) << "P1-Z" << setw(6) << " "
                        << "P2-X" << setw(6) << "P2-Y" << setw(6) << "P1-Z" << setw(5) << " " << "Length" << endl;
                cout << " - - - - - - - - - - - - - - - - - - - - - - - - - - - -" << endl;
                for (int i = 0; i < line3DVector.size(); i++){
                    cout << line3DVector[i]->toString();
                }
            }
            // DSC order
            else{
                // Sorting
               sort(line3DVector.begin(), line3DVector.end(), [](Line3D* lhs, Line3D* rhs) {
                  return lhs->getScalarValue() > rhs->getScalarValue();
               });
               // Display
                cout << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(6) << "P1-Z" << setw(6) << " "
                        << "P2-X" << setw(6) << "P2-Y" << setw(6) << "P1-Z" << setw(5) << " " << "Length" << endl;
                cout << " - - - - - - - - - - - - - - - - - - - - - - - - - - - -" << endl;
                for (int i = 0; i < line3DVector.size(); i++){
                    cout << line3DVector[i]->toString();
                }
            }
        }
    }


}


void storeData(){

    string fileName;
    string addOn = ".txt";
    int noOfRecords;

    cout << "\nPlease enter filename: ";
    cin >> fileName;


    // Case if user didn't input .txt at the filename
    if (fileName.find(addOn) == string::npos) {
        fileName.append(".txt");
    }

    ofstream myfile(fileName);

    if (filterCriteria == "Point2D"){
        if (myfile.is_open())
        {
            // Header
            myfile << setw(6) << "X" << setw(6) << "Y" << setw(5) << " " << "Dist. Fr Origin" << endl;
            myfile << " - - - - - - - - - - - - - - - - - - -" << endl;
            // Write to file
            for (int i = 0; i < point2DVector.size(); i++){
                myfile << point2DVector[i]->toString();
            }
            myfile.close();
            noOfRecords = point2DVector.size();
        }
    }

    else if (filterCriteria == "Point3D"){
        if (myfile.is_open())
        {
            // Header
            myfile << setw(6) << "X" << setw(6) << "Y" << setw(6) << "Z" << setw(5) << " " << "Dist. Fr Origin" << endl;
            myfile << " - - - - - - - - - - - - - - - - - - -" << endl;
            // Write to file
            for (int i = 0; i < point3DVector.size(); i++){
                myfile << point3DVector[i]->toString();
            }
            myfile.close();
            noOfRecords = point3DVector.size();
        }
    }
    else if (filterCriteria == "Line2D"){
        if (sortingCriteria == "Length"){
            if (myfile.is_open())
            {
                // Header
                myfile << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(6) << "P1-Z" << setw(6) << " "
                        << "P2-X" << setw(6) << "P2-Y" << setw(6) << "P1-Z" << setw(5) << " " << "Length" << endl;
                myfile << " - - - - - - - - - - - - - - - - - - - - - - - - - - - -" << endl;
                // Write to file
                for (int i = 0; i < line2DVector.size(); i++){
                    myfile << line2DVector[i]->toString();
                }
                myfile.close();
                noOfRecords = line2DVector.size();
            }
        }
        else{
            if (myfile.is_open())
            {
                // Header
                myfile << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(6) << "P1-Z" << setw(6) << " "
                        << "P2-X" << setw(6) << "P2-Y" << setw(6) << "P1-Z" << setw(5) << " " << "Length" << endl;
                myfile << " - - - - - - - - - - - - - - - - - - - - - - - - - - - -" << endl;
                // Write to file
                for (int i = 0; i < lineStrings.size(); i++){
                    myfile << lineStrings[i];
                }
                myfile.close();
                noOfRecords = lineStrings.size();
            }
        }
    }

    // Line3D
    else{
        if (sortingCriteria == "Length"){
            if (myfile.is_open())
            {
                // Header
                myfile << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(6) << "P1-Z" << setw(6) << " "
                        << "P2-X" << setw(6) << "P2-Y" << setw(6) << "P1-Z" << setw(5) << " " << "Length" << endl;
                myfile << " - - - - - - - - - - - - - - - - - - - - - - - - - - - -" << endl;
                // Write to file
                for (int i = 0; i < line3DVector.size(); i++){
                    myfile << line3DVector[i]->toString();
                }
                myfile.close();
                noOfRecords = line3DVector.size();
            }
        }
        else{
            if (myfile.is_open())
            {
                // Header
                myfile << setw(6) << "P1-X" << setw(6) << "P1-Y" << setw(6) << "P1-Z" << setw(6) << " "
                        << "P2-X" << setw(6) << "P2-Y" << setw(6) << "P1-Z" << setw(5) << " " << "Length" << endl;
                myfile << " - - - - - - - - - - - - - - - - - - - - - - - - - - - -" << endl;
                // Write to file
                for (int i = 0; i < lineStrings.size(); i++){
                    myfile << lineStrings[i];
                }
                myfile.close();
                noOfRecords = lineStrings.size();
            }
        }

    }

    cout << endl;
    cout << noOfRecords << " records output successfully!" << endl;
    cout << "\nGoing back to main menu...\n" << endl;
}






