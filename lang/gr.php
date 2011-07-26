<?php
	
// deps/main.php	
define('__TITLE', 'Κοινωνικοί Σελιδοδείκτες');

// index.php
define('__HOMEPAGE', 'Κεντρική Σελίδα');
define('__ALLCOMMENTS', 'Όλα τα σχόλια');
define('__NEWEST', 'Πρόσφατες Καταχωρήσεις');
define('__POPULAR', 'Δημοφιλείς Καταχωρήσεις');
define('__NEWESTTAB', 'Πρόσφατοι');
define('__POPULARTAB', 'Δημοφιλείς');
define('__RATEDTAB', 'Καλύτερα');
define('__VISITEDTAB', 'Επισκεψιμότητα');
define('__SEARCH', 'Αναζήτηση');

// add.php
define('__ADDBOOKMARK', 'Προσθήκη Σελιδοδείκτη');
define('__BOOKMARKADD', 'Προσθήκη');
define('__BOOKMARKURL', 'URL');
define('__BOOKMARKTITLE','Τίτλος');
define('__BOOKMARKDESCRIPTION','Περιγραφή');
define('__BOOKMARKTAGS','Ετικέτες');

// addresult.php
define('__BOOKMARKADDED', 'Ο σελιδοδείκτης καταχωρήθηκε!');
define('__VISITBOOKMARK', 'Δείτε την καταχώρησή σας');
define('__ADDANOTHER', 'Προσθέστε άλλο σελιδοδείκτη');
define('__RETURNTOMAIN', 'Επιστρέψτε στην κεντρική σελίδα');
define('__NOTALLDETAILS', 'Δεν έχετε καταχωρήσει όλα τα απαιτούμενα στοιχεία.');

// viewbookmark.php
define('__VIEWBOOKMARK', 'Προβολή Σελιδοδείκτη');
define('__DESCRIPTION', 'Περιγραφή');
define('__RATING', 'Βαθμολογία');
define('__COMMENTS', 'Σχόλια');
define('__ONDATE', 'Στις');
define('__COMMUSER', 'ο/η χρήστης');
define('__COMMPOSTED', 'δημοσίευσε');
define('__COMMADDED', 'πρόσθεσε αυτή τη σελίδα στους σελιδοδείκτες του με τίτλο');
define('__COMMDESC', 'και την περιγραφή');
define('__DATECREATED', 'Ημερομηνία δημιουργίας');
define('__TAGS', 'Ετικέτες');
define('__SHOWSUGGESTED', 'Εμφάνιση άλλων προτεινόμενων τίτλων');
define('__ADDCOMMENT', 'Προσθήκη Σχόλιου');
define('__BENICE', 'Θυμηθείτε να είστε πάντα ευγενικοί στα σχόλιά σας. Προσβλητικά σχόλια θα διαγράφονται.');
define('__VISITHTTPS', 'Επισκεφθείτε τον ιστότοπο μέσω ασφαλούς σύνδεσης HTTPS (εφ\'όσων διατίθεται)');
define('__SHOWOTHERTAGS', 'Εμφάνιση και των υπόλοιπων ετικετών');
define('__ADDTOMINE', 'Προσθήκη στους σελιδοδείκτες μου');
define('__PLUSONEONTITLE', "+1 σε αυτόν τον τίτλο");
define('__MINUSONEONTITLE', "-1 σε αυτόν τον τίτλο");
define('__PLUSONE', '+1 σε αυτό το σελιδοδείκτη');
define('__MINUSONE', '-1 σε αυτό το σελιδοδείκτη');
define('__OWN', 'Έχετε καταχωρήσει αυτό το σελιδοδείκτη');
define('__OWNERS', 'Χρήστες');

// database.inc
/// insertBookmark()
define('__BOOKMARKEXISTS', 'Έχετε ήδη καταχωρήσει σελιδοδείκτη για αυτή τη σελίδα.');
define('__USEREXISTS', 'Ο χρήστης υπάρχει ήδη στο σύστημα');
define('__EMAILEXISTS', 'Το email αυτό χρησιμοποιείται από άλλο λογαριασμό');

// registration.php
define('__REGISTRATION', 'Εγγραφή Νέου Χρήστη');
define('__REGISTERBUTTON','Εγγραφή');
define('__USERNAME','Όνομα Χρήστη');
define('__EMAIL','Διεύθυνση Ηλ. Ταχυδρομίου');
define('__PASSWORD','Κωδικός Πρόσβασης');

// report.php
define('__REPORT', 'Αναφορά σελιδοδείκτη');
define('__SUREREPORT', 'Είστε σίγουροι ότι θέλετε να αναφέρετε αυτό το σελιδοδείκτη;');
define('__SUREREPORT2', 'Πραγματοποιήστε την αναφορά μόνο αν θεωρείτε το περιεχόμενο προσβλητικό ή παράνομο.');
define('__CONFIRM', 'Επιβεβαίωση');

// edit.php
define('__EDIT', 'Επεξεργασία σελιδοδείκτη');
define('__NOWEDITING', 'Επεξεργάζεστε το σελιδοδείκτη με URL');
define('__ONLYADDTAGS', 'Μπορείτε μόνο να προσθέσετε ετικέτες');
define('__KEEPRATING', 'Διατήρηση της βαθμολογίας του τίτλου');
define('__KEEPRATINGNOTICE', 'Χρησιμοποιείστε την παραπάνω επιλογή μόνο εάν κάνετε μικρές αλλαγές (διόρθωση ορθογραφικού λάθους, κλπ.)');

// delete.php
define('__DELETE', 'Διαγραφή σελιδοδείκτη');
define('__SUREDELETE', 'Είστε σίγουροι ότι θέλετε να διαγράψετε αυτό το σελιδοδείκτη;');
define('__SUREDELETE2', 'Η ενέργια αυτή είναι μη αναστρέψιμη.');
define('__SUREDELETE3', 'Αν και άλλοι χρήστες έχουν καταχωρήσει το σελιδοδείκτη, ο σελιδοδείκτης θα παραμείνει στην υπηρεσία, αλλά θα αφαιρεθεί από το προφίλ σας, καθώς και ο τίτλος και η περιγραφή που δώσατε, ανεξαρτήτως βαθμολογίας. Οι ετικέτες που προσθέσατε δε θα διαγραφούν, εκτός της περίπτωσης που διαγραφεί και ο σελιδοδείκτης.');
define('__GOBACK', 'Επιστροφή');
define('__DELETECOMMENTS', 'Διαγραφή και όλων των σχολίων που έχετε κάνει στο σελιδοδείκτη');
?>
