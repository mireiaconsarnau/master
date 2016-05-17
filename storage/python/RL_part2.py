#! /usr/bin/env python
import sys
import os
import matplotlib

matplotlib.use( 'Agg' )
import numpy as np
import pylab

from textstat import textstat
import codecs
#%pylab inline
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

class Radar(object):

    def __init__(self, fig, titles, labels, rect=None):
        if rect is None:
            rect = [0.95, 0.95, 0.95, 0.95]

        self.n = len(titles)
        self.angles = np.arange(90, 90+360, 360.0/self.n)
        self.axes = [fig.add_axes(rect, projection="polar", label="axes%d" % i) 
                         for i in range(self.n)]

        self.ax = self.axes[0]
        self.ax.set_thetagrids(self.angles, labels=titles, fontsize=14)

        for ax in self.axes[1:]:
            ax.patch.set_visible(False)
            ax.grid("off")
            ax.xaxis.set_visible(False)

        for ax, angle, label in zip(self.axes, self.angles, labels):
            ax.set_rgrids(range(1, 10), angle=angle, labels=label)
            ax.spines["polar"].set_visible(False)
            ax.set_ylim(1, 10)

    def plot(self, values, *args, **kw):
        angle = np.deg2rad(np.r_[self.angles, self.angles[0]])
        values = np.r_[values, values[0]]
        self.ax.plot(angle, values, *args, **kw)




fig = pylab.figure(figsize=(6, 6))

titles = ["flesch", "smog", "flesch_kincaid", "coleman", "automated", "dale chall", "difficult_words","linsear_write","gunning_fog", "text_standard"]


labels = [
    list("1234567890")

]

radar = Radar(fig, titles, labels)
radar.plot([A,B,C,D,E,F,G,H,I,J],  "-", lw=4, color="b", alpha=0.4, label="USER TRAIN")
radar.plot([A+3,B+3,C+3,D+3,E+3,F+3,G+3,H+3,I,J],  "-", lw=2, color="R", alpha=0.4, label="USER TASK TEST")
radar.ax.legend()
pylab.show()


