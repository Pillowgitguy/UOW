#include <iostream>
#include <cmath>
#include <iomanip>
#include<bits/stdc++.h>
#include "Line3D.h"
#include "Point3D.h"

using namespace std;


// Line3D default constructor
Line3D :: Line3D(){

}

// Line3D other constructor
Line3D :: Line3D(Point3D pt1, Point3D pt2){
    this-> pt1 = pt1;
    this-> pt2 = pt2;
    setLength();

}

// Accessor method
Point3D Line3D :: getPt1(){
    return pt1;
};

Point3D Line3D :: getPt2(){
    return pt2;
};


// Setter method
void Line3D :: setPt1(Point3D pt1){
    this-> pt1 = pt1;
};

void Line3D :: setPt2(Point3D pt2){
    this-> pt2 = pt2;
};

void Line3D :: setLength(){
    length = sqrt ( pow((pt1.getX() - pt2.getX()), 2) + pow((pt1.getY() - pt2.getY()), 2) + pow( (pt1.getZ() - pt2.getZ() ), 2));

};

string Line3D :: toString(){

    ostringstream oss;
    oss << " [" << setw(4) << pt1.getX() << ", " << setw(4) << pt1.getY() << ", " << setw(4) << pt1.getZ() << "]   ";
    oss << " [" << setw(4) << pt2.getX() << ", " << setw(4) << pt2.getY() << ", " << setw(4) << pt2.getZ() << "]   ";
    oss << setprecision(3) << fixed << length << endl;
    return (oss.str());
}


