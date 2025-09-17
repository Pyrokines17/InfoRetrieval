def validate_bracket_sequence(bracket_sequence_arg: str) -> bool:
    if bracket_sequence_arg[0] == ')':
        return False

    bracket_stack = []
    stack_size = 0

    for char in bracket_sequence_arg:
        if stack_size == 0:
            bracket_stack.append(char)
            stack_size += 1
            continue

        if bracket_stack[-1] == '(' and char == ')':
            bracket_stack.pop()
            stack_size -= 1
        else:
            bracket_stack.append(char)
            stack_size += 1

    if stack_size == 0:
        return True
    else:
        return False

def pre_process(input_str: str) -> bool:
    for char in input_str:
        if char != '(' and char != ')':
            return False

    return True

if __name__ == '__main__':
    print("Which option of input?")
    print("1. Input by file")
    print("2. Input by cmd")

    choose_input_str = input("Enter option [1,2]: ")

    try:
        choose_input_int = int(choose_input_str)

        if choose_input_int == 1:
            file_name = input("Enter file name: ")

            try:
                file = open(file_name, 'r')
                line = file.readline()
                row = 1

                while line:
                    if line[-1] == '\n':
                        line = line[:-1]

                    if line != "":
                        if pre_process(line):
                            if validate_bracket_sequence(line):
                                print(f"Row {row}: Sequence valid")
                            else:
                                print(f"Row {row}: Sequence not valid")
                        else:
                            print(f"Row {row}: String contain invalid characters")
                    else:
                        print(f"Row {row}: String is empty")

                    line = file.readline()
                    row += 1

                file.close()
            except FileNotFoundError as e1:
                print(e1)

        elif choose_input_int == 2:
            bracket_sequence = input("Enter bracket sequence: ")

            if bracket_sequence != "":
                if pre_process(bracket_sequence):
                    if validate_bracket_sequence(bracket_sequence):
                        print("Sequence valid")
                    else:
                        print("Sequence not valid")
                else:
                    print("String contain invalid characters")
            else:
                print("String is empty")

        else:
            raise ValueError("You should enter either 1 or 2")
    except ValueError as e2:
        print(e2)
