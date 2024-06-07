#include <iostream>
#include <sstream>
#include <string>
#include "ShapeTwoD.h"

using namespace std;


// ShapeTwoD default constructor
ShapeTwoD :: ShapeTwoD(){

}

// ShapeTwoD other constructor
ShapeTwoD :: ShapeTwoD(string name, bool containsWarpSpace){

    cout<<"Constructor executed" << endl;
    this->name = name;
    this->containsWarpSpace = containsWarpSpace;

}

// ShapeTwoD destructor
ShapeTwoD :: ~ShapeTwoD(){

}

// ShapeTwoD accessor methods
string ShapeTwoD :: getName(){

    return name;
}

bool ShapeTwoD :: getContainWarpSpace(){

    return containsWarpSpace;
}

// ShapeTwoD setter method
string ShapeTwoD :: setName(string name){

    this->name = name;

}

bool ShapeTwoD :: setcontainsWarpSpace(bool containsWarpSpace){

    this->containsWarpSpace = containsWarpSpace;

}

// ShapeTwoD toString method
string ShapeTwoD :: toString() const{

    ostringstream oss;
    oss << "Name: " << name << ", contains warp space: " << containsWarpSpace << endl;
    return (oss.str());
}

double ShapeTwoD :: computeArea(){
    return 10.0;
}
bool ShapeTwoD :: isPointInShape(int x, int y){
    return true;
};
bool ShapeTwoD :: isPointOnShape(int x, int y){
    return true;
}

