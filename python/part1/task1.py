def print_pascal_triangle(rows_count: int) -> None:
    for row in range(1, rows_count + 1):
        tmp_value = 1

        for col in range(1, row + 1):
            print(tmp_value, end=" ")
            tmp_value = tmp_value * (row - col) // col

        print()

if __name__ == '__main__':
    input_str = input("Enter the number of rows: ")

    try:
        input_int = int(input_str)

        if input_int < 1:
            raise ValueError("Enter a positive integer")

        print_pascal_triangle(input_int)
    except ValueError as e:
        print(e)
