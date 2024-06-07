#include <iostream>
#include <sstream>
#include <string>
#include "Square.h"

using namespace std;


// Square default constructor
Square :: Square(){


}
// Square other constructor
Square :: Square(string name, bool containsWarpSpace, string specialType, vector<int> actualVertexData) : ShapeTwoD (name, containsWarpSpace){

    this->specialType = specialType;
    this->actualVertexData = actualVertexData;
    inShape(pointsInShape);
    onShape(pointsOnPerimeter);
    area = computeArea();

}

// Square accessor methods
int Square :: getNoOfVertices(){
    return noOfVertices;
}

string Square :: getSpecialType(){
    return specialType;
}

// Square toString method
string Square :: toString() const{

    ostringstream oss;
    string WS;

    if (containsWarpSpace == 1){
        WS = "WS";
    }
    else{
        WS = "NS";
    }
    oss << "Name:  " << name << endl;
    oss << "Special Type: " << WS << endl;
    oss << "Area: " << area << " units square" << endl;


    oss << "Points on perimeter: ";
    for (int i = 0; i < pointsOnPerimeter.size(); i = i + 2 ){

        if (i < pointsOnPerimeter.size()-2){
                oss <<  "("<<pointsOnPerimeter[i] << ", " << pointsOnPerimeter[i+1] << "),";
        }
        else{
                oss <<  "("<<pointsOnPerimeter[i] << ", " << pointsOnPerimeter[i+1] << ")";
        }

    }
    oss << endl;

    oss << "Points on within Shape: ";
    for (int i = 0; i < pointsInShape.size(); i = i + 2 ){
        if (i < pointsInShape.size()-2){
                oss <<  "("<<pointsInShape[i] << ", " << pointsInShape[i+1] << "),";
        }
        else{
                oss <<  "("<<pointsInShape[i] << ", " << pointsInShape[i+1] << ")";
        }

    }
    oss << endl;

    return (oss.str());
}


// Square other methods
double Square :: computeArea(){

    double firstX = actualVertexData[0];
    double secondX;
    // Looping through comparing the value to find the second x
    for (int i = 0; i < actualVertexData.size(); i = i + 2 ){
        if (actualVertexData[i] != firstX){
            secondX = actualVertexData[i];
        }
    }


    /* By subtracting the secondX from the firstX, we will get the length.
       Afterwards, to get the area of the square, we times the length together
    */
    return (firstX - secondX)*(firstX - secondX);

}


void Square :: inShape(vector<int> &pointsInShape){

 int firstX = actualVertexData[0];
    int firstY = actualVertexData[1];
    int secondX;
    int secondY;
    int checker = 1;
    int xOnShapeChecker;
    int yOnShapeChecker;
    int base;
    int base2;
    int length;
    int counter = 0;

    for (int i = 0; i < actualVertexData.size(); i = i + 2){

        // Get the y value on the same x-axis
        if(actualVertexData[i] == firstX){
            secondY = actualVertexData[i+1];
        }

        // Get the x value that is furthest from x
        if(actualVertexData[i] != firstX){
            secondX = actualVertexData[i];
        }
    }

    // Find the total length of the square
    length = abs(firstX - secondX);

    // Second X and Second Y is more than first X and first X
    if (firstX < secondX && firstY < secondY){
        base = firstX+1;
        base2 = firstY+1;
        for (int i = 0; i < length-1; i++){
            for (int j = 0; j < length-1; j++){
                pointsInShape.push_back(base++);
                pointsInShape.push_back(base2+counter);
            }
            base = firstX+1;
            base2 = firstY+1;
            counter++;
        }

    }

    // Second X is more but First Y is more
    else if (firstX < secondX && firstY > secondY){

        base = firstX+1;
        base2 = secondY+1;
        for (int i = 0; i < length-1; i++ ){
            for (int j = 0; j < length-1; j++){
                pointsInShape.push_back(base++);
                pointsInShape.push_back(base2+counter);
            }
        base = firstX+1;
        base2 = secondY+1;
        counter++;
        }

    }
    // First X is more but Second Y is more
    else if (firstX > secondX && secondY > firstY){
        base = secondX+1;
        base2 = firstY+1;
        for (int i = 0; i < length-1; i++ ){
            for (int j = 0; j < length-1; j++){
                pointsInShape.push_back(base++);
                pointsInShape.push_back(base2+counter);
            }
        base = secondX+1;
        base2 = firstY+1;
        counter++;
        }
    }
    // First X and first Y is more
    else {
        base = secondX+1;
        base2 = secondY+1;
        for (int i = 0; i < length-1; i++){
            for (int j = 0; j < length-1; j++){
                pointsInShape.push_back(base++);
                pointsInShape.push_back(base2+counter);
            }
            base = secondX+1;
            base2 = secondY+1;
            counter++;
        }
    }

}

bool Square :: isPointInShape(int x, int y){

    bool result = false;

    // Looping through the vector to check if the x,y inputted got appear
    for (int i = 0; i < pointsInShape.size(); i++){
        if (x == pointsInShape[i] && y == pointsInShape[i+1]){
            result = true;
        }
    }

    return result;

};



void Square :: onShape(vector<int> &pointsOnPerimeter){

    int firstX = actualVertexData[0];
    int firstY = actualVertexData[1];
    int secondX;
    int secondY;
    int length;
    int base;
    int base2;


    for (int i = 0; i < actualVertexData.size(); i = i + 2){

        // Get the y value on the same x-axis
        if(actualVertexData[i] == firstX){
            secondY = actualVertexData[i+1];
        }

        // Get the x value that is furthest from x
        if(actualVertexData[i] != firstX){
            secondX = actualVertexData[i];
        }
    }

    // Find the total length of the square
    length = abs(firstX - secondX);

    // Second X and Second Y is more than first X and Second X
    if (firstX < secondX && firstY < secondY){
        base = firstX;
        base2 = firstY;

        // Lowest grid E.g. 0,0 1,0 2,0 3,0 4,0
        for (int i = 0; i <= length; i++){
            for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base++;
                }
            }

        }
        base = firstX;
        base2 = secondY;

        // Highest grid E.g. 0,4 1,4 2,4 3,4 4,4
        for (int i = 0; i <= length; i++){
            for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base++;
                }
            }
        }

        base = firstX;
        base2 = firstY;

        // Left grid bottom to top E.g. 0,0 0,1 0,2 0,3 0,4
        for (int i = 0; i <= length; i++){
            for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base2++;
                }
            }
        }

        base = secondX;
        base2 = firstY;

        // Right grid bottom to top E.g. 4,0 4,1 4,2 4,3 4,4
        for (int i = 0; i <= length; i++){
            for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base2++;
                }
            }
        }

    }

    // Second X is more but First Y is more
    else if (firstX < secondX && firstY > secondY){

        base = firstX;
        base2 = secondY;
        // Lowest grid E.g. 0,0 1,0 2,0 3,0 4,0
        for (int i = 0; i <= length; i++){
            for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base++;
                }
            }
        }


        base = firstX;
        base2 = secondX;

        // Highest grid E.g. 0,4 1,4 2,4 3,4 4,4
        for (int i = 0; i <= length; i++){
            for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base++;
                }
            }
        }

        // Left grid bottom to top E.g. 0,0 0,1 0,2 0,3 0,4
        base = firstX;
        base2 = secondY;

        for (int i = 0; i <= length; i++){
            for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base2++;
                }
            }
        }

        // Right grid bottom to top E.g. 4,0 4,1 4,2 4,3 4,4
        base = secondX;
        base2 = secondY;

        for (int i = 0; i <= length; i++){
            for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base2++;
                }
            }
        }

    }

    // First X is more but Second Y is more
    else if (firstX > secondX && secondY > firstY){
        base = secondX;
        base2 = firstY;

        // Lowest grid E.g. 0,0 1,0 2,0 3,0 4,0
        for (int i = 0; i <= length; i++){
            for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base++;
                }
            }
        }

        base = secondX;
        base2 = secondY;
        // Highest grid E.g. 0,4 1,4 2,4 3,4 4,4
        for (int i = 0; i <= length; i++){
              for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base++;
                }
            }
        }

        base = secondX;
        base2 = firstY;
        // Left grid bottom to top E.g. 0,0 0,1 0,2 0,3 0,4
        for (int i = 0; i <= length; i++){
            for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base2++;
                }
            }
        }

        base = firstX;
        base2 = firstY;

        // Right grid bottom to top E.g. 4,0 4,1 4,2 4,3 4,4
        for (int i = 0; i <= length; i++){
            for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base2++;
                }
            }
        }

    }
    // First X and first Y is more
    else {
        base = secondX;
        base2 = secondY;

        // Lowest grid E.g. 0,0 1,0 2,0 3,0 4,0
        for (int i = 0; i <= length; i++){
            for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base++;
                }
            }
        }

        base = secondX;
        base2 = firstX;
        // Highest grid E.g. 0,4 1,4 2,4 3,4 4,4
        for (int i = 0; i <= length; i++){
            for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base++;
                }
            }
        }

        base = secondX;
        base2 = secondY;
        // Left grid bottom to top E.g. 0,0 0,1 0,2 0,3 0,4
        for (int i = 0; i <= length; i++){
            for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base2++;
                }
            }
        }

        base = firstX;
        base2 = secondY;
        // Right grid bottom to top E.g. 4,0 4,1 4,2 4,3 4,4
        for (int i = 0; i <= length; i++){
            for (int j = 0; j < actualVertexData.size(); j = j + 2 ){
                if (base != actualVertexData[j] && base2 != actualVertexData[j+1]){
                        pointsOnPerimeter.push_back(base);
                        pointsOnPerimeter.push_back(base2);
                        base2++;
                }
            }
        }

    }

}


bool Square :: isPointOnShape(int x, int y){

    bool result = false;

    // Looping through the vector to check if the x,y inputted got appear
    for (int i = 0; i < pointsOnPerimeter.size(); i++){
        if (x == pointsOnPerimeter[i] && y == pointsOnPerimeter[i+1]){
            result = true;
        }
    }

    return result;
}

