%pylab inline
import numpy as np
import pylab as pl
import matplotlib

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