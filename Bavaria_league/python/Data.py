import csv

# Read the data from the CSV file and convert it into a list of dictionaries.
file = open("./data/Voetbal_Bavaria_League_tussenstand.csv", "r", encoding = "UTF-8")
reader = csv.DictReader(file)
dataList = list(reader)

def total():
    totalFouls = 0

    # For each datapoint add the total amount of fouls to the total.
    for data in dataList:
        fouls = data['overtredingen']
        totalFouls += int(fouls)

    totalFile = open("./data/total.txt", "w", encoding = "UTF-8")
    totalFile.write(f"{totalFouls}")
    return totalFouls

def averageFoul():
    totalMatches = 0
    lastMatch = None

    # Count the total number of matches and the number of matches where the same team has played before.
    for data in dataList:
        if lastMatch is None or not lastMatch is data['team1']:
            totalMatches += 1
        else:
            continue

    # Calculate the average number of fouls per match.
    avFouls = round(total() / totalMatches)

    avFoulFile = open("./data/averageFoul.txt", "w", encoding = "UTF-8")
    avFoulFile.write(f"{avFouls}")
        

def blackBook():
    # Sort the data by the total number of fouls in descending order.
    dataSorted = sorted(dataList, key=lambda row: int(row['overtredingen']), reverse=True)
    # Sort bij the top 10
    bookList = dataSorted[:10]
    avFoulFile = open("./data/blackBook.txt", "w", encoding="UTF-8")

    for book in bookList:
        avFoulFile.write(f"{book['datum']}, {book['team1']}, {book['team2']}, {book['uitslag']}, {book['scheidsrechter']}, {book['overtredingen']}\n")

def hallOfFame():
    from datetime import datetime, timedelta

    today = datetime.now()
    # Get all of the dates from the previous 21 days.
    checkDate = today - timedelta(days=21)

    hallOfFameFile = open("./data/hallOfFame.txt", "w", encoding="UTF-8")

    for data in dataList:
        # Convert the date string to a datetime object.
        dataDate = datetime.strptime(data['datum'], "%d/%m/%Y")
            
        # If the date is within the last 21 days and the total number of fouls is less than or equal to 1, add the data to the hall of fame.
        if dataDate >= checkDate and int(data['overtredingen']) <= 1:
            hallOfFameFile.write(f"{data['datum']}, {data['team1']}, {data['team2']}, {data['uitslag']}, {data['scheidsrechter']}\n")

def run():
    # Run the functions to calculate and write the data to the files.
    total()
    averageFoul()
    blackBook()
    hallOfFame()

# Call the main function to run the program.
run()