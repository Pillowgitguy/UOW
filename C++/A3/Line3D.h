#ifndef LINE3D_H_INCLUDED
#define LINE3D_H_INCLUDED

#include "Line2D.h"
#include "Point3D.h"

class Line3D : public Line2D{

private:
    Point3D pt1;
    Point3D pt2;

protected:
    void setLength();

public:

    // Default constructor
    Line3D();

    // Other constructor
    Line3D(Point3D pt1, Point3D pt2);

    // Accessor method
    Point3D getPt1();
    Point3D getPt2();

    // Setter method
    void setPt1(Point3D pt1);
    void setPt2(Point3D pt2);

    // toString method
    string toString();

};





#endif // LINE3D_H_INCLUDED
