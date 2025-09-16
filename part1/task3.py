import sys

english_alphabet_list = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
                         'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
                         'U', 'V', 'W', 'X', 'Y', 'Z']

russian_alphabet_list = ['А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И',
                         'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т',
                         'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь',
                         'Э', 'Ю', 'Я']

def caesar_cipher(string_arg: str, shift_arg: int, alphabet: list) -> str:
    result = ''

    for char in string_arg:
        if char.upper() not in alphabet:
            result += char
            continue

        is_lowercase = char.islower()
        new_char = alphabet[(alphabet.index(char.upper()) + shift_arg) % len(alphabet)]

        if is_lowercase:
            new_char = new_char.lower()

        result += new_char

    return result

def get_name_without_extension(filename: str) -> str:
    if filename.endswith('.txt'):
        return filename[:-4]
    else:
        return filename

if __name__ == '__main__':
    if len(sys.argv) < 4:
        sys.exit(f'Usage: python {sys.argv[0]} <input-file> <shift> <lang> (lang: en, ru)')

    try:
        input_file_name = sys.argv[1]
        shift = int(sys.argv[2])
        lang = sys.argv[3]
        alp_list = None

        if lang == 'en':
            alp_list = english_alphabet_list
        elif lang == 'ru':
            alp_list = russian_alphabet_list
        else:
            raise ValueError(f'Unknown language: {lang}')

        file = open(input_file_name, 'r')

        output_filename = f'{get_name_without_extension(input_file_name)}.shifted.txt'
        output_file = open(output_filename, 'w')

        line = file.readline()

        while line:
            output_file.write(caesar_cipher(line, shift, alp_list))
            line = file.readline()

        file.close()
        output_file.close()
    except ValueError as value_error:
        print(value_error)
    except FileNotFoundError as file_not_found_error:
        print(file_not_found_error)
