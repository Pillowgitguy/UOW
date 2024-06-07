#include <iostream>
#include <cmath>
#include <iomanip>
#include<bits/stdc++.h>
#include "Point2D.h"

using namespace std;


// Point2D default constructor
Point2D :: Point2D(){

}

// Point2D other constructor
Point2D :: Point2D(int x, int y){
    this->x = x;
    this->y = y;
    setDisFrOrigin();

}

// Point2D destructor
Point2D :: ~Point2D(){

}

// Accessor method
int Point2D :: getX(){
    return x;
};

int Point2D :: getY(){
    return y;
};
int Point2D :: getScalarValue(){
    return disFrOrigin;
};


// Setter method
void Point2D :: setX(int x){
    this-> x = x;
};
void Point2D :: setY(int y){
    this-> y = y;
};
void Point2D :: setDisFrOrigin(){
    disFrOrigin = sqrt( pow(x, 2) + pow(y, 2));
};

// Overload operator
ostream& operator<<(ostream& output, const Point2D& pt){

    output << "X: " << pt.x << ", Y: " << pt.y;
    return output;

}



// toString method
string Point2D :: toString() const{

    ostringstream oss;
    oss << " [" << setw(4) << x << ", " << setw(4) << y  << "]   ";
    oss << setprecision(3) << fixed << disFrOrigin << endl;
    return (oss.str());
}








