#include <iostream>
#include <cmath>
#include <iomanip>
#include<bits/stdc++.h>
#include "Line2D.h"

using namespace std;


// Line2D default constructor
Line2D :: Line2D(){

}

// Point2D other constructor
Line2D :: Line2D(Point2D pt1, Point2D pt2){
    this->pt1 = pt1;
    this->pt2 = pt2;
    setLength();
}

// Line2D destructor
Line2D :: ~Line2D(){

}

// Accessor method
Point2D Line2D :: getPt1(){
    return pt1;
};

Point2D Line2D :: getPt2(){
    return pt2;
};
double Line2D :: getScalarValue(){
    return length;
};


// Setter method
void Line2D :: setPt1(Point2D pt1){
    this-> pt1 = pt1;
};
void Line2D :: setPt2(Point2D pt2){
    this-> pt2 = pt2;
};
void Line2D :: setLength(){
    length = sqrt ( pow((pt1.getX() - pt2.getX()), 2) + pow((pt1.getY() - pt2.getY()), 2));
};

// toString method
string Line2D :: toString(){

    ostringstream oss;
    oss << " [" << setw(4) << pt1.getX() << ", " << setw(4) << pt1.getY()  << "]   ";
    oss << " [" << setw(4) << pt2.getX() << ", " << setw(4) << pt2.getY()  << "]   ";
    oss << setprecision(3) << fixed << length << endl;
    return (oss.str());
}









