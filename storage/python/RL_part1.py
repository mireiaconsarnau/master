#! /usr/bin/env python
import sys
import os

from textstat import textstat
import codecs

print ("User: "+sys.argv[2])
print ("Task: "+sys.argv[1])
print ("\n")

test_data =  codecs.open('/var/www/html/masterv1/storage/uploads/%s/test/%s/%s' % (sys.argv[1],sys.argv[2],sys.argv[3])).read().lower()

A= (textstat.flesch_reading_ease(test_data)/10)
B= (textstat.smog_index(test_data))
C= (textstat.flesch_kincaid_grade(test_data))
D= (textstat.coleman_liau_index(test_data))
E= (textstat.automated_readability_index(test_data))
F= (textstat.dale_chall_readability_score(test_data))
G= ((textstat.difficult_words(test_data))/100)
H= (textstat.linsear_write_formula(test_data))
I= (textstat.gunning_fog(test_data))
J= (textstat.text_standard(test_data)[0])
K=(textstat.text_standard(test_data))
print("flesch_reading_ease: %r \n Smog Index: %r \n flesch_kincaid_grade: %r \n coleman_liau_index %r \n automated_readability_index %r \n dale_chall %r \n difficult_words %r \n linsear_write_formula %r \n gunning_fog %r \n text_standard %r" %(A,B,C,D,E,F,G,H,I,K))