import os

nb = 0

while nb < 1 or nb > 9:

	nb = int(input("saisissez un nombre: "))

for k in range(1,11):
	print(nb, ' x ', k, ' = ', nb*k)

os.system("pause")