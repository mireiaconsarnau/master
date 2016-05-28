#! /usr/bin/env python
import sys
import os
import numpy as np
import matplotlib
import matplotlib.path as path
import matplotlib.pyplot as plt
import matplotlib.patches as patches
from textstat import textstat
import codecs

test_data =  codecs.open('/var/www/html/masterv1/storage/uploads/train/%s/%s' % (sys.argv[1],sys.argv[2])).read().lower()

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
#print("%r %r %r %r %r %r %r %r %r " %(A,B,C,D,E,F,G,H,I))
print(A)
print(B)
print(C)
print(D)
print(E)
print(F)
print(G)
print(H)
print(I)