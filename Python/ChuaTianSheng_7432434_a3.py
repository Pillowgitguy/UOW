name = 'Chua Tian Sheng'  # (1) REPLACE THE STRING VARIABLE WITH YOUR NAME in string type
student_num = '7432434' # (2) REPLACE THIS STRING VARIABLE WITH YOUR UOW ID in string type
subject_code = 'CSIT110'

# (2) insert class and function definitions here.
# Qn 1
class Price:
    # Class variable
    currency = 'SGD'

    # Constructor
    def __init__(self, value : float):
        self.value = value

    # 1b __str__ dunder method
    def __str__(self):
        return f"${self.value :.2f}"
    # Qn 1b
    def __repr__(self):
        return f"${self.value :.2f}"

# 1c
class OutOfStockError(Exception):
    # Constructor
    def __init__(self, item : str):
        self.item = item

    # __str__ method
    def __str__(self):
        return f"The following item {self.item} is out of stock!"

# 2a
class Inventory:
    # Class variables
    hotline = "1800-1333-5432"
    items = {}

    # 2b
    @classmethod
    def set_items_from_list(cls, list_of_items):
        # Loop to go through the list of items
        for index in range(0, len(list_of_items)):
            # x dictionary containing price and stock values
            x = {"price": float(list_of_items[index][1]), "stock": int(list_of_items[index][2])}
            # Mapping item name to x
            cls.items[str(list_of_items[index][0])] = x

    # 3a
    @classmethod
    def order(cls):
        y = {}
        try:
            for item, price_stock in cls.items.items():
                user_input = int(input("How many " + item + " would you like to order? "))
                if user_input > int(price_stock.get('stock')):
                    raise OutOfStockError(item)
                elif user_input > 0:
                    y [str(item)] = user_input
            return y
        finally:
            pass

# 3b
def collate_orders(n :int):

    # Creating dictionary variable
    z = {"invalid": 0, "valid": 0, "oos": 0}

    # Counting variables
    invalid = 0
    valid = 0
    oos = 0

    while n != 0:
        try:
            user_input = Inventory.order()
            valid = valid + user_input.get('Eggs') + user_input.get('Milk') + user_input.get('Tea')
            n -= 1
        except OutOfStockError:
            oos += 1
            n -= 1
        except ValueError:
            invalid +=1
            n -= 1

    # Assigning value to the keys
    z["invalid"] = invalid
    z["valid"] = valid
    z["oos"] = oos

    return z

# 4a
def get_nric_checksum(numerical_series : str):
    number_list = []
    weight_list = [2, 7, 6, 5, 4, 3, 2]
    total_sum = 0
    check_sum_letter_dict = {10: "A",
                            9 : "B",
                            8 : "C",
                            7 : "D",
                            6 : "E",
                            5 : "F",
                            4 : "G",
                            3 : "H",
                            2 : "I",
                            1 : "Z",
                            0 : "J"}

    # Adding the numbers into a list
    for letter in numerical_series:
        number_list.append(letter)

    # Multiplying each number to the weights
    for index in range(0, len(number_list)):
        d = int(number_list[index]) * weight_list [index]
        total_sum = total_sum + d

    # Mod the final total sum by 11 and return value from the dict respectively
    return check_sum_letter_dict[total_sum % 11]

# 4b
def get_vehicle_plate_checksum(prefix_num : str):
    letters_to_numbers_dict = {"A" : 1,
                            "B" : 2,
                            "C" : 3,
                            "D" : 4,
                            "E" : 5,
                            "F" : 6,
                            "G" : 7,
                            "H" : 8,
                            "I" : 9,
                            "J" : 10,
                            "K" : 11,
                            "L" : 12,
                            "M" : 13,
                            "N" : 14,
                            "O" : 15,
                            "P" : 16,
                            "Q" : 17,
                            "R" : 18,
                            "S" : 19,
                            "T" : 20,
                            "U" : 21,
                            "V" : 22,
                            "W" : 23,
                            "X" : 24,
                            "Y" : 25,
                            "Z" : 26}
    check_sum_letter_dict = {0: "A ",
                             1: "Z",
                             2: "Y",
                             3: "X",
                             4: "U",
                             5: "T",
                             6: "S",
                             7: "R",
                             8: "P",
                             9: "M",
                             10: "L",
                             11: "K",
                             12: "J",
                             13: "H",
                             14: "G",
                             15: "E",
                             16: "D",
                             17: "C",
                             19: "B"}
    #A, Z, Y, X, U, T, S, R, P, M, L, K, J, H, G, E, D, C, B
    weight_list = [9, 4, 5, 4, 3, 2]


    letters_list = []
    digits_list = []
    letters_to_use = []
    digits_to_use = []
    letters_and_digits = []
    total_sum = 0

    #Taking letters and numbers from parameter into lists
    for char in prefix_num:
        if char.isalpha():
            letters_list.append(char)
        elif char.isdigit():
            digits_list.append(char)

    # Converting letter to numbers
    if len(letters_list) == 3:
        letters_to_use.append(letters_to_numbers_dict.get(letters_list[1]))
        letters_to_use.append(letters_to_numbers_dict.get(letters_list[2]))
    elif len(letters_list) == 2:
        letters_to_use.append(letters_to_numbers_dict.get(letters_list[0]))
        letters_to_use.append(letters_to_numbers_dict.get(letters_list[1]))
    else:
        letters_to_use.append(0)
        letters_to_use.append(letters_to_numbers_dict.get(letters_list[0]))

    # Making sure it got 4 digits
    if len(digits_list) == 3:
        digits_to_use.append(0)
        digits_to_use.extend([int(x) for x in digits_list])
    elif len(digits_list) == 2:
        digits_to_use.append(0)
        digits_to_use.append(0)
        digits_to_use.extend([int(x) for x in digits_list])
    elif len(digits_list) == 1:
        digits_to_use.append(0)
        digits_to_use.append(0)
        digits_to_use.append(0)
        digits_to_use.extend([int(x) for x in digits_list])
    else:
        digits_to_use.extend([int(x) for x in digits_list])

    # Combining the letters-turn-digits and 4-digits together
    letters_and_digits.extend(letters_to_use)
    letters_and_digits.extend(digits_to_use)

    # Finding the total sum
    for index in range(0, len(letters_and_digits)):
        d = (letters_and_digits[index]) * weight_list[index]
        total_sum = total_sum + d

    # Mod the final total sum by 19 and return value from the dict respectively
    return check_sum_letter_dict[total_sum % 19]

def main():
    print("Assignment 3")
    # (3) test your code here
    # E.g. by calling the functions
    # or creating instances here

    #Qn 1a
    pricetag = Price(2.89)
    print(Price.currency)
    print(pricetag.value)

    #Qn 1b
    print(pricetag)

    #Qn 1b
    print(repr(pricetag))

    #1c
    try:
        raise OutOfStockError("Eggs")
    except OutOfStockError as e:
        print(e)

    #2a
    print(Inventory.hotline)
    print(Inventory.items)

    #2b
    print(Inventory.items)
    Inventory.set_items_from_list(
        [["Eggs", 2.98, 12], ["Milk", 4.65, 3]])
    print(Inventory.items)

    #3a
    Inventory.set_items_from_list(
        [
            ["Eggs", 2.98, 12],
            ["Milk", 4.65, 8],
            ["Tea", 1.50, 6]]
    )
    print(Inventory.order())
    #Inventory.order()

    #3b
    Inventory.set_items_from_list(
        [
            ["Eggs", 2.98, 12],
            ["Milk", 4.65, 8],
            ["Tea", 1.50, 6]]
    )
    print(collate_orders(4))

    #4a
    get_nric_checksum('1111111')

    #4b
    get_vehicle_plate_checksum("SBS3229")

if __name__ == "__main__":
    main()
    
