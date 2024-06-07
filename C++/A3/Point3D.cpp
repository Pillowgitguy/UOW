#include <iostream>
#include <cmath>
#include <iomanip>
#include<bits/stdc++.h>
#include "Point3D.h"

using namespace std;

// Point3D default constructor
Point3D :: Point3D(){

}

// Point3D other constructor
Point3D :: Point3D(int x, int y, int z) : Point2D(x, y){
    this-> z = z;
    setDisFrOrigin();
}

// Accessor method
int Point3D :: getZ(){
    return z;
};

// Setter method
void Point3D :: setZ(int z){
    this-> z = z;
};

void Point3D :: setDisFrOrigin(){
    disFrOrigin = sqrt( pow(x, 2) + pow(y, 2) + pow(z, 2));
};

// Overload operator
ostream& operator<<(ostream& output, const Point3D& pt){

    output << "X: " << pt.x << ", Y: " << pt.y << ", X: " << pt.z;
    return output;

}


// toString method
string Point3D :: toString() const{

    ostringstream oss;
    oss << " [" << setw(4) << x << ", " << setw(4) << y << ", " << setw(4) <<z << "]   ";
    oss << setprecision(3) << fixed << disFrOrigin << endl;
    return (oss.str());

}
