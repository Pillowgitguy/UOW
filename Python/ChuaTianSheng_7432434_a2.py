#========== Edit student info ===================#
name = 'Chua Tian Sheng'  # (1) REPLACE THE STRING VARIABLE WITH YOUR NAME in string type
student_num = '7432434' # (2) REPLACE THIS STRING VARIABLE WITH YOUR UOW ID in string type
subject_code = 'CSIT110'
#========== End of student info =================#
#========== Define function definitions here ====#
# Question 1
def tiktok(n: int):

    # Variables
    tiktok_list =[]
    number_seven = 7
    number_four = 4

    # Creating the list
    for number in range(1, n+1):
        tiktok_list.append(number)

    # For loop to check each number in the list and if it meets the requirement, change the value accordingly
    for integer in range(1, n + 1):
        if (integer%number_four == 0) and (integer%number_seven == 0):
            tiktok_list[integer-1] = 'TikTok'
        elif integer%number_seven == 0:
            tiktok_list[integer-1] = 'Tok'
        elif integer%number_four== 0:
            tiktok_list[integer-1] = 'Tik'
        else:
            continue

    return tiktok_list

# Question 2
def get_interest_rates():

    elderly = False
    more_than_20000 = False

    # Getting user information
    user_age = float(input("Enter current age: "))
    user_oa = float(input("Enter current amount in OA: "))
    user_sa = float(input("Enter current amount in SA: "))
    user_ma = float(input("Enter current amount in MA: "))

    # Getting user amount in RA if user is 55yrs old or more
    if user_age >= 55:
        user_ra = float(input("Enter current amount in RA: "))
        elderly = True

    # Getting base interest
    # 2.5% on OA
    base_interest = user_oa * 0.025
    # 4% on SA
    base_interest = base_interest + (user_sa * 0.04)
    # 4% on MA
    base_interest = base_interest + (user_ma * 0.04)

    # If user is 55yrs old or more
    if elderly:
        base_interest = base_interest + (user_ra * 0.04)

    # Test if user OA is > than 20k
    if user_oa >= 20_000:
        more_than_20000 = True

    # Extra interest if elderly and has more than 20k in their OA
    if elderly and more_than_20000:
        # if the sum of all account is more than 30k
        if (20_000 + user_sa + user_ma + user_ra) >= 30_000:
            total_interest = base_interest + (30_000 * 0.02)
            balance = 20_000 + user_sa + user_ma + user_ra - 30_000
            # if the balance after deducting the first 30k is more than 30k
            if balance > 30_000:
                total_interest = total_interest + (30_000 * 0.01)
            else:
                total_interest = total_interest + (balance * 0.01)
        # if the sum of all account is less than 30k
        else:
            total_interest = base_interest + ((user_oa + user_sa + user_ma + user_ra) * 0.02)
    # Extra interest if elderly and has less than 20k in their OA
    elif elderly:
        # if the sum of all account is more than 30k
        if (user_oa + user_sa + user_ma + user_ra) >= 30_000:
            total_interest = base_interest + (30_000 * 0.02)
            balance = user_oa + user_sa + user_ma + user_ra - 30_000
            # if the balance after deducting the first 30k is more than 30k
            if balance > 30_000:
                total_interest = total_interest + (30_000 * 0.01)
            else:
                total_interest = total_interest + (balance * 0.01)
        # if the sum of all account is less than 30k
        else:
            total_interest = base_interest + ((user_oa + user_sa + user_ma + user_ra) * 0.02)
    # Not elderly
    else:
        # if their OA is more than 20k
        if more_than_20000:
            # if their total sum is more than 60k
            if (20_000 + user_sa + user_ma) == 60_000:
                total_interest = base_interest + (60_000 * 0.01)
            else:
                total_interest = base_interest + ((20_000 + user_sa + user_ma) * 0.01)
        # if their OA is less than 20k
        else:
            total_interest = base_interest + ((user_oa + user_sa + user_ma) * 0.01)

    print(f'Your interest rate this year will be ${total_interest:.2f}')

# Question 3
def get_booking():

    number_of_single_rooms = int(input("Number of Single rooms: "))
    number_of_twin_rooms = int(input("Number of Twin rooms: "))
    number_of_deluxe_rooms = int(input("Number of Deluxe rooms: "))
    number_of_suite = int(input("Number of Suite: "))
    number_of_nights = int(input("Length of stay(number of nights): "))
    total_number_of_rooms = number_of_single_rooms + number_of_twin_rooms + number_of_deluxe_rooms + number_of_suite

    single_rooms_cost = number_of_single_rooms * 90 * number_of_nights
    twin_rooms_cost = number_of_twin_rooms * 150 * number_of_nights
    deluxe_rooms_cost = number_of_deluxe_rooms * 250 * number_of_nights
    suite_rooms_cost = number_of_suite * 1050 * number_of_nights
    subtotal = single_rooms_cost + twin_rooms_cost + deluxe_rooms_cost + suite_rooms_cost
    nett_total = subtotal * 1.07

    print("")
    print(f'Summary of your booking for {number_of_nights} nights(s)')
    print(f'{"Single room" :<13}{number_of_single_rooms :^3}{"${:.2f}".format(single_rooms_cost) :>10}')
    print(f'{"Twin room" :<13}{ number_of_twin_rooms :^3}{"${:.2f}".format(twin_rooms_cost) :>10}')
    print(f'{"Deluxe room":<13}{number_of_deluxe_rooms :^3}{"${:.2f}".format(deluxe_rooms_cost) :>10}')
    print(f'{"Suite" :<13}{number_of_suite :^3}{"${:.2f}".format(suite_rooms_cost) :>10}')
    print(f'{"Subtotal" :<13}{total_number_of_rooms :^3}{"${:.2f}".format(subtotal) :>10}')
    print(f'{"Total(7% g.s.t)": <16}{"${:.2f}".format(nett_total) :>10}')

# Question 4
def recover_files():
    # Variables to be used
    recover_files_list = []
    returned_string = ""

    while True:
        # Prompting user to enter file_name
        file_name = input("Filename?")
        # Counting the number of occurrence of {
        number_of_curly_bracket = file_name.count("{")

        # While the number of curly is not 0
        while number_of_curly_bracket != 0:
            first_index = file_name.find("{")
            last_index = file_name.find("}")
            # Clearing the content of {} and {, }
            file_name = file_name[:first_index] + file_name[last_index+1:]
            number_of_curly_bracket -= 1

        # Add the cleared file name to the list
        recover_files_list.append(str(file_name))

        # if empty string is given, exit the loop
        if not file_name:
            break


    # Creating the string to be returned
    for index in range(0, len(recover_files_list)):
        if index < len(recover_files_list)-2:
            returned_string += recover_files_list[index] + ","
        else:
            returned_string += recover_files_list[index]

    return returned_string

#========== End of function definition===========#
def main():   ## DO NOT EDIT THIS LINE.
    print("Assignment2")  ## DO NOT EDIT THIS LINE.
    #========== Call your functions here ========#
    # Question 1
    result = tiktok(45)
    print(result)

    #Question 2
    get_interest_rates()

    #Question 3
    get_booking()

    #Question 4
    x = recover_files()
    print(x)
    #========== End of function calls ===========#

if __name__ == '__main__':  ## DO NOT EDIT THIS LINE.
    main()  ## DO NOT EDIT THIS LINE.