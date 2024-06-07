#ifndef POINT3D_H_INCLUDED
#define POINT3D_H_INCLUDED

#include "Point2D.h"

class Point3D : public Point2D{

protected:
    int z;
    void setDisFrOrigin();

public:

    // Default constructor
    Point3D();

    // Other constructor
    Point3D(int x, int y, int z);

    // Accessor method
    int getZ();

    // Setter method
    void setZ(int z);

    // Overload operator
    friend ostream& operator<<(ostream& output, const Point3D& pt);

    // toString method
    string toString() const;


};

ostream& operator<<(ostream& output, const Point3D& pt);


#endif // POINT3D_H_INCLUDED
